<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Ticket;

class TicketsController extends Controller
{
    //Listado de tickets
    public function index(Request $request){
        //Defino las variables que puede recibir el request
        $id = $request->get('id');
        $status = $request->get('status');

        //Consulta según el parámetro
        $tickets = Ticket::id($id)->orWhere->status($status)->get();
        return json_encode($tickets);
    }

    //Crear un ticket
    public function create(Request $request) {
        //Definición de mensajes de error y validación de parámetros
        $messages = [
            'username.required' => __('messages.username_required_field'),
            'description.required' => __('messages.description_required_field'),
        ];

        $rules = [
            'username' => 'required',
            'description' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        //Devuelve errores
        if($validator->fails()){
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            return json_encode([
                'status' => 'error',
                'message' => json_encode($errors)
            ]);
        }

        //Defino arreglo de datos, estableciendo open por defecto
        $data = [
            'username' => $request->username,
            'description' =>$request->description,
            'status' => 'open'
        ];

        $ticket = new Ticket($data);
        if($ticket->save()) {
            return json_encode([
                'status' => 'success',
                'message' => __('messages.ticket_success_created', ['id' => $ticket->id])
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'message' => __('messages.ticket_fail_created')
            ]);
        }
    }

    public function update(Request $request) {
        //Definición de mensajes de error y validación de parámetros
        $messages = [
            'id.required' => __('messages.id_required_field'),
            'id.numeric' => __('messages.id_numeric_field'),
            'id.exists' => __('messages.id_exists_field'),
            'username.required' => __('messages.username_required_field'),
            'description.required' => __('messages.description_required_field'),
            'status.required' => __('messasges.status_required_field'),
            'status.in' => __('messages.status_in_field')
        ];

        $rules = [
            'id' => 'required|numeric|exists:tickets,id',
            'username' => 'required',
            'description' => 'required',
            'status' => 'required|in:open,closed'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        //Devuelve errores
        if($validator->fails()){
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            return json_encode([
                'status' => 'error',
                'message' => json_encode($errors)
            ]);
        }

        //Ecuentra el ticket y llena los datos para actualización
        $ticket = Ticket::find($request->id);
        $data = [
            'username' => $request->username,
            'description' =>$request->description,
            'status' => $request->status
        ];
        $ticket->fill($data);
        if($ticket->save()) {
            return json_encode([
                'status' => 'success',
                'message' => __('messages.ticket_success_updated', ['id' => $ticket->id])
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'message' => __('messages.ticket_fail_updated')
            ]);
        }
    }

    public function destroy(Request $request) {
        //Definición de mensajes de error y validación de parámetros
        $messages = [
            'id.required' => __('messages.id_required_field'),
            'id.numeric' => __('messages.id_numeric_field'),
            'id.exists' => __('messages.id_exists_field'),
        ];

        $rules = [
            'id' => 'required|numeric|exists:tickets,id',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        //Devuelve errores
        if($validator->fails()){
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            return json_encode([
                'status' => 'error',
                'message' => json_encode($errors)
            ]);
        }

        $ticket = Ticket::find($request->id);
        if($ticket->delete()) {
            return json_encode([
                'status' => 'success',
                'message' => __('messages.ticket_success_deleted', ['id' => $ticket->id])
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'message' => __('messages.ticket_fail_deleted')
            ]);
        }
    }
}
