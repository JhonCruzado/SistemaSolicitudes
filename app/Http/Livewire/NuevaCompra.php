<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Colaborador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PHPMailer\PHPMailer\PHPMailer;

class NuevaCompra extends Component
{
    public $subtotal = 0, $grado, $cantotal, $total = 0; //compra
    public $idColaborador, $colaborador, $search; //colaborador
    public $codigo, $producto,  $precio; //producto
    public $cantidadtotal, $cantidad, $_subtotal = 0, $__subtotal = 0;
    public $key = 1;
    public $_colaborador = false;
    public $table = array();
    public $add = true, $compra = false;


    public function render()
    {
        $colaboradores = Colaborador::orderBy('id_colaborador','ASC')->where('nombres', 'like', '%' . $this->search . '%')->paginate(7);
        $grados = DB::table('urgencia')->get();
        return view('livewire.solicitudes.nueva', compact('colaboradores','grados'));
    }

    public function updatedCantidad()
    {
        $cant = (floatval($this->precio) * floatval($this->cantidad)) ?? 0;
        if ($cant >= 0) {
            $this->add = true;
            $this->_subtotal = $cant ?? 0;
            $this->oldSubtotal = $cant ?? 0;
        } else {
            $this->add = false;
            $this->_subtotal = 0;
            $this->oldSubtotal = 0;
        }
    }

   /*public function addColaborador(Colaborador $model)
    {
        $this->idColaborador = $model->id_colaborador;
        $this->colaborador = $model->nombres;
        $this->_colaborador = false;
    } */

    public function addDetalle()
    {
        if ($this->grado == null) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "No ha ingresado el grado de urgencia!!"]);
            return;
        }
        /* if ($this->codigo == null) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "No ha ingresado el codigo del producto!!"]);
            return;
        } */
        if ($this->producto == null) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "No ha ingresado el producto!!"]);
            return;
        }
        if ($this->precio == null) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "No ha ingresado el precio!!"]);
            return;
        }
        if ($this->cantidad == null) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "No ha ingresado la cantidad!!"]);
            return;
        }

        $ok = true;
        foreach ($this->table as $i => $value) {
            if ($value['producto'] == $this->producto) {
                $ok = false;
                $this->dispatchBrowserEvent('alertWarning', ['title' => "Advertencia", 'text' => "El producto ya está en el detalle!"]);
            }
        }

        if ($ok) {
            $this->table[] = [
                'codigo' => $this->key,
                'producto' => $this->producto,
                'precio' => $this->precio,
                'cantidad' => $this->cantidad,
                'subtotal' => $this->_subtotal,
            ];
            $this->__subtotal += $this->_subtotal;
            $this->cantidadtotal += $this->cantidad;
            $this->total = $this->__subtotal;
            $this->cantotal = $this->cantidadtotal;
            $this->limpiarInfoProducto();
            $this->dispatchBrowserEvent('alertSuccess', ['title' => "Detalle compra", 'text' => "El producto se agregó al detalle!"]);
            $this->key = $this->key + 1;
        }
    }

    public function removeDetalle($_codigo)
    {
        foreach ($this->table as $i => $value) {
            if ($value['codigo'] == $_codigo) {
                $this->__subtotal -= $value['subtotal'];
                $this->cantidadtotal -= $value['cantidad'];
                $this->total = $this->__subtotal;
                $this->cantotal = $this->cantidadtotal;
                unset($this->table[$i]);
                $this->dispatchBrowserEvent('alertSuccess', ['title' => "Detalle compra", 'text' => "El producto se quitó del detalle!"]);
                $this->key = $this->key - 1;
            }
        }
    }

    public function save()
    {
        if (!count($this->table)) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Advertencia", 'text' => "No hay productos en el detalle!"]);
            return;
        }

        // Cargo
        $datos = DB::table('colaborador as c')
        ->select(DB::raw('CONCAT(car.cargo, " ", dp.area) AS cargo'),'c.nombres','c.id_colaborador as id')
        ->join('cargo as car', 'car.id_cargo', '=', 'c.cargo_id')
        ->join('colaborador_area as cd', 'cd.colaborador_id', '=', 'c.id_colaborador')
        ->join('area as dp', 'dp.id_area', '=', 'cd.area_id')
        ->where('c.nombres', '=', Auth::user()->nombre)
        ->get();

        // Asignando el grado elegido
        $gradoElegido = DB::table('urgencia')->select('grado')->where('id_urgencia', 'like', $this->grado)->get();
        $gradoElegido = $gradoElegido[0]->grado;

        // Obteniendo emails a enviar correos
        if ($this->total > 1000) {
            $datosGerente = Colaborador::where('cargo_id', 'like', 4)->get();
            $emailGerente = $datosGerente[0]->email;

            $datosJefeDepartamento = DB::table('colaborador_area as ca')
                ->join('area as ar', 'ar.id_area', '=', 'ca.area_id')
                ->join('colaborador_dep as cd', 'cd.departamento_id', '=', 'ar.departamento_id')
                ->join('colaborador as c', 'c.id_colaborador', '=', 'cd.colaborador_id')
                ->where('ca.colaborador_id', 'like', $datos[0]->id)
                ->get();
            $emailJefeDepartamento = $datosJefeDepartamento[0]->email;

            $datosJefeArea = Colaborador::where('nombres', '=', Auth::user()->nombre)->get();
            $emailJefeArea = $datosJefeArea[0]->email;
        }else if ($this->total > 100 && $this->total <= 1000) {
            $datosJefeDepartamento = DB::table('colaborador_area as ca')
                ->join('area as ar', 'ar.id_area', '=', 'ca.area_id')
                ->join('colaborador_dep as cd', 'cd.departamento_id', '=', 'ar.departamento_id')
                ->join('colaborador as c', 'c.id_colaborador', '=', 'cd.colaborador_id')
                ->where('ca.colaborador_id', 'like', $datos[0]->id)
                ->get();
            $emailJefeDepartamento = $datosJefeDepartamento[0]->email;

            $datosJefeArea = Colaborador::where('nombres', '=', Auth::user()->nombre)->get();
            $emailJefeArea = $datosJefeArea[0]->email;
        }else{
            $datosJefeArea = Colaborador::where('nombres', '=', Auth::user()->nombre)->get();
            $emailJefeArea = $datosJefeArea[0]->email;
        }

        // evaluando cantidad de aprobaciones
        if ($this->total > 1000) {
            $aprobaciones=3;
        }else if ($this->total > 100 && $this->total <= 1000) {
            $aprobaciones=2;
        }else{
            $aprobaciones=1;
        }

        DB::beginTransaction();
        try {
            $id = DB::table('solicitud_compra')->insertGetId([
                'colaborador_id' => Auth::user()->id,
                'grado_urgencia' => $gradoElegido,
                'monto_total' => $this->total,
                'cantidad_total' => $this->cantotal,
                'fecha' => date('Y-m-d H:i:s'),
                'Aprobaciones' => $aprobaciones,
                'estado' => 'En Proceso'
            ]);

            foreach ($this->table as $i => $value) {
                DB::table('detalle_solicitud_compraa')->insert([
                    'solicitud_id' => $id,
                    'producto' => $value['producto'],
                    'precio' => $value['precio'],
                    'cantidad' => $value['cantidad']
                ]);
            }

            // Enviar correo a los jefes correspondientes para Aprobacion
            $mail = new PHPMailer();
            $mail->IsSMTP();

            //Configuracion servidor mail
            $mail->From = "smtp@gmail.com"; //remitente
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls'; //seguridad
            $mail->Host = "smtp.gmail.com"; // servidor smtp
            $mail->Port = 587; //puerto

            $mail->Username = 'jpcdc.service@gmail.com'; //nombre usuario
            $mail->Password = 'zvqxpjsrrxlolpfm'; //contraseña

            $mail->setFrom('jpcdc.service@gmail.com', 'Comercial El Valle');

            // Obteniendo emails a enviar correos
            if ($this->total > 1000) {
                $mail->addAddress($emailGerente);     //Add a recipient
                $mail->addAddress($emailJefeDepartamento);     //Add a recipient
                $mail->addAddress($emailJefeArea);     //Add a recipient
            }else if ($this->total > 100 && $this->total <= 1000) {
                $mail->addAddress($emailJefeDepartamento);     //Add a recipient
                $mail->addAddress($emailJefeArea);     //Add a recipient
            }else{
                $mail->addAddress($emailJefeArea);     //Add a recipient
            }

            $DataSol = '<p>Buen dia, le saluda el '.$datos[0]->cargo.', el motivo de este correo es para solicitar la aprobación de la compra de productos para nuestra área, los cuales se detallan a continuación.
            <br><br>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-1">
                            <h3 class="m-0">
                                &nbsp;&nbsp;Proforma de Compra
                            </h3>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-1">
                            <h5 class="m-0">
                                <div style="margin-bottom: 4px;aling-items:right;" >
                                    <b style="font-weight: bold;">N° Proforma:</b>
                                    <span>'.$id.'</span>
                                </div><br>
                                <div style="margin-bottom: 4px;aling-items:right;" >
                                    <b style="font-weight: bold;">Solicitante:</b>
                                    <span>'.Auth::user()->nombre.'</span>
                                </div><br>
                                <div style="margin-bottom: 4px;">
                                    <b style="font-weight: bold;">Grado de Urgencia:</b>
                                    <span>'.$gradoElegido.'</span>
                                </div><br>
                                <div style="margin-bottom: 4px;">
                                    <b style="font-weight: bold;">Cargo:</b>
                                    <span>'.$datos[0]->cargo.'</span>
                                </div><br>
                                <div style="margin-bottom: 4px;">
                                    <b style="font-weight: bold;">Fecha de Solicitud:</b>
                                    <span>'.date('Y-m-d H:i:s').'</span>
                                </div><br>
                                <div style="margin-bottom: 4px;">
                                    <b style="font-weight: bold;">Total:</b>
                                    <span>'.$this->total.'</span>
                                </div>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-0">
                <div class="table-responsive bg-white table-shadow">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Cantidad</th>
                                <th>Precio (S/.)</th>
                                <th>Producto</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->table as $t)
                                <tr>
                                    <td>0</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            Para poder aceptar o rechazar está solicitud presione uno de los siguientes botones:
            <br><br>
            <div class="text-center">
                <button onclick="window.location.href="http://127.0.0.1:8000/solicitudes" " type="button"   class="btn btn-info mt-1">
                    <span>Aceptar solicitud</span>
                </button>
            </div>
            <div class="text-center">
                <button onclick="window.location.href="http://127.0.0.1:8000/solicitudes" " type="button"   class="btn btn-danger mt-1">
                    <span>Rechazar solicitud</span>
                </button>
            </div>
            </p>';

            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Aprobacion';
            $mail->Body    = $DataSol;
            /* dd($mail); */
            $mail->send();
            /* if(!$mail->send()) {
                echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message enviado con éxito.';
            } */

            DB::commit();

            $this->limpiarCampos();
            return $this->dispatchBrowserEvent('alertSuccess', ['title' => "Nueva solicitud", 'text' => "Solicitud registrada!"]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd(throw $e);
            return $this->dispatchBrowserEvent('alertWarning', ['title' => "Nueva solicitud", 'text' => "Ocurrio un error!"]);
        }
    }

    /* public function updatedDescuento()
    {
        if ($this->cantidad > 0 && $this->descuento > 0) {
            if ($this->_subtotal > $this->descuento) {
                $this->add = true;
                $cant = floatval($this->oldSubtotal) - floatval($this->descuento);
                $this->_subtotal = $cant ?? 0;
            } else {
                $this->add = false;
                $this->_subtotal = $this->oldSubtotal;
            }
        } else {
            $this->add = true;
            $this->_subtotal = $this->oldSubtotal;
        }
    }

    public function buscarProducto()
    {
        $movimientos = Caja::all();
        $cantdatos = $movimientos->count();
        if ($cantdatos == null) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "Debe aperturar caja!"]);
            return;
        }
        if ($this->sku == null) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "No ha ingresado el SKU!!"]);
            return;
        }
        $producto = Producto::where('id_producto', '=', $this->sku)->first();
        if (!$producto) {
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "SKU no encontrado!!"]);
            return;
        }
        $this->producto = $producto->producto;
        $this->stock = $producto->stock;
    }

    public function updatedPagado()
    {
        if ($this->subtotal > 0 && $this->pagado >= $this->subtotal) {
            $cant = floatval($this->pagado) - floatval($this->total);
            if ($cant < 0) {
                $this->vuelto = 0;
            } else {
                $this->vuelto = $cant ?? 0;
            }
        } else {
            $this->vuelto = 0;
        }
    } */

    public function limpiarInfoProducto()
    {
        $this->reset(['codigo','producto','precio', 'cantidad', '_subtotal']);
    }

    public function limpiarCampos()
    {
        $this->reset(['grado', 'codigo', 'producto', 'precio', 'cantidad', 'subtotal', 'colaborador', 'cantotal', 'table','total','cantidadtotal']);
        $this->reset(['_subtotal', '__subtotal']);
        $this->_colaborador = false;
        $this->limpiarValidation();
    }

    public function limpiarValidation()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
