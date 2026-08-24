<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TiendaTest extends TestCase
{
    use RefreshDatabase;

    protected function crearProducto(float $precio = 10000): Producto
    {
        $categoria = Categoria::create(['nombre' => 'Prueba']);

        return Producto::create([
            'categoria_id' => $categoria->id,
            'nombre' => 'Producto de prueba',
            'descripcion' => 'Descripcion de prueba',
            'precio' => $precio,
            'stock' => 10,
        ]);
    }

    public function test_el_catalogo_de_productos_se_puede_ver_sin_iniciar_sesion(): void
    {
        $this->crearProducto();

        $response = $this->get(route('productos.index'));

        $response->assertStatus(200);
        $response->assertSee('Producto de prueba');
    }

    public function test_un_usuario_no_autenticado_no_puede_ver_el_carrito(): void
    {
        $response = $this->get(route('carrito.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_un_usuario_autenticado_puede_agregar_un_producto_al_carrito(): void
    {
        $user = User::factory()->create();
        $producto = $this->crearProducto();

        $response = $this->actingAs($user)->post(route('carrito.agregar', $producto), [
            'cantidad' => 2,
        ]);

        $response->assertRedirect(route('carrito.index'));
        $this->assertEquals(2, session('carrito')[$producto->id]);
    }

    public function test_el_carrito_calcula_impuestos_y_envio_correctamente(): void
    {
        $user = User::factory()->create();
        $producto = $this->crearProducto(10000);

        $this->actingAs($user)->post(route('carrito.agregar', $producto), ['cantidad' => 1]);

        $response = $this->actingAs($user)->get(route('carrito.index'));

        // subtotal 10000, impuestos 13% = 1300, envio fijo 2500, total = 13800
        $response->assertSee('1,300.00', false);
        $response->assertSee('13,800.00', false);
    }

    public function test_el_checkout_crea_un_pedido_con_numero_de_seguimiento(): void
    {
        $user = User::factory()->create();
        $producto = $this->crearProducto(10000);

        $this->actingAs($user)->post(route('carrito.agregar', $producto), ['cantidad' => 1]);

        $response = $this->actingAs($user)->post(route('checkout.procesar'), [
            'metodo_pago' => 'Tarjeta de credito',
        ]);

        $this->assertDatabaseCount('pedidos', 1);
        $this->assertDatabaseHas('pedidos', [
            'user_id' => $user->id,
            'metodo_pago' => 'Tarjeta de credito',
        ]);

        $pedido = \App\Models\Pedido::first();
        $this->assertStringStartsWith('TT-', $pedido->numero_seguimiento);

        $response->assertRedirect(route('pedidos.show', $pedido));
    }
}
