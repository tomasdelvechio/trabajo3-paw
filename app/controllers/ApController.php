<?php
namespace App\Controllers;

use App\Core\Controller;
use App\models\Appointment;


/*/**
 * @property Appointment models
 */
class ApController extends Controller
{
    /*public function __construct()
    {
        $this->models = new Appointment();
    }*/

    public function index()
    {
       return view('index.views');
    }

    public  function newAp() {
        return view('new.appointment');
    }

    public function saveAp ()
    {
        $appointment = new Appointment();
        $params = array(
            "nombre" => $_POST["nombre"],
            "email" => $_POST["email"],
            "telefono" => $_POST["telefono"],
            "edad" => $_POST["edad"],
            "talla_calzado" => $_POST["talla_calzado"],
            "altura" => $_POST["altura"],
            "fecha_nacimiento" => $_POST["fecha_nacimiento"],
            "color_pelo" => $_POST["color_pelo"],
            "fecha_turno" => $_POST["fecha_turno"],
            "horario_turno" => $_POST["horario_turno"],
            "diagnostico" => $_FILES,
        );
        $respuesta = $appointment->validarInsert($params);
        $errores = array_shift($respuesta);
        if ($errores == "Correcto") {
            $ap = $appointment->findturno();
            return view('views.appointment', compact('ap')) ;
        }
        elseif ($errores == "Incorrecto") {
            return view('error.views', compact('respuesta'));
        }
        elseif ($errores == "Imagen Pesada") {
            return view('error.views', compact('respuesta'));
        }
    }

    public function listAp() {
        $appointment = new Appointment();
        $appointments = $appointment->all();
        return view('list.appointments', compact('appointments'));
    }

    public function viewAp() {
        $appointment = new Appointment();
        $ap = $appointment->findid($_GET['id']);
        $diagnostico64 = base64_encode($ap['diagnostico']);
        //var_dump($ap);
        return view('views.appointment', compact('ap', 'diagnostico64'));
    }

    public function editAp() {
        $appointment = new Appointment();
        $ap = $appointment->findid($_GET['id']);
        return view('edit.appointment', compact('ap'));
    }

    public function uptAp() {
        $appointment = new Appointment();
        $params = $this->comparacion();
        $respuesta = $appointment->validarUpdate($params, $_POST['id']);
        $errores = array_shift($respuesta);
        if ($errores == "Correcto") {
            $ap = $appointment->findid($_POST['id']);
            return view('views.appointment', compact('ap')) ;
        }
        elseif ($errores == "Incorrecto") {
            return view('error.views', compact('respuesta'));
        }
        elseif ($errores == "Imagen Pesada") {
            return view('error.views', compact('respuesta'));
        }
    }

    public function delAp() {
        $appointment = new Appointment();
        $appointment->delete($_GET['id']);
        $appointments = $appointment->all();
        return view('list.appointments', compact('appointments'));
    }

    private function comparacion() {
        $appointment = new Appointment();
        $old = $appointment->findid($_POST['id']);
        $params = array();
        if ($old["nombre"] != $_POST["nombre"]) $params["nombre"] = $_POST["nombre"];
        if ($old["email"] != $_POST["email"]) $params["email"] = $_POST["email"];
        if ($old["telefono"] != $_POST["telefono"]) $params["telefono"] = $_POST["telefono"];
        if ($old["edad"] != $_POST["edad"]) $params["edad"] = $_POST["edad"];
        if ($old["talla_calzado"] != $_POST["talla_calzado"]) $params["talla_calzado"] = $_POST["talla_calzado"];
        if ($old["altura"] != $_POST["altura"]) $params["altura"] = $_POST["altura"];
        if ($old["fecha_nacimiento"] != $_POST["fecha_nacimiento"]) $params["fecha_nacimiento"] = $_POST["fecha_nacimiento"];
        if ($old["color_pelo"] != $_POST["color_pelo"]) $params["color_pelo"] = $_POST["color_pelo"];
        if ($old["fecha_turno"] != $_POST["fecha_turno"]) $params["fecha_turno"] = $_POST["fecha_turno"];
        if ($old["horario_turno"] != $_POST["horario_turno"]) $params["horario_turno"] = $_POST["horario_turno"];
        //if ($old["diagnostico"] != $_POST["diagnostico"]) $params["diagnostico"] = $_FILES;

        return $params;
    }
}