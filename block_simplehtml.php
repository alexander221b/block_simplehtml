<?php
class block_simplehtml extends block_base {
    public function init() {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }
    // The PHP tag and the curly bracket for the class definition 
    // will only be closed after there is another function added in the next section.

    //Indicamos que el bloque tiene configuración
    function has_config(){
      return true;
    }

     public function get_content() {
        //Iterface entre el código y la base de datos
        global $DB;
        global $USER;
       
        
        //Verifica si se ha creado el contenido previamente para evitar re crearlo
        if ($this->content !== null) {
          return $this->content;
        }

        //Cadena vacía para concatenar los datos del usuario
        $contenido = '';

        //obtenemos la configuración del bloque anteriormente definida en settings.php
        $showcourses = get_config('block_simplehtml', 'showcourses');
        
        //Si la opción mostrar cursos está activa muestra los cursos, de lo contrario los usuarios
        if ($showcourses) {
            $courses = $DB->get_records('course');
            foreach ($courses as $course) {
                $contenido .= $course->fullname.'<br>';
            }
        }
        else{
            //Almacena los usuarios de la plataforma en una variable. get_records es una función de Moodle
            $users = $DB->get_records('user');
            //Recorre los usuarios traidos de la base de datos
            foreach ($users as $user) {
                $contenido .= $user->firstname . ' ' . $user->lastname.' '. $USER->id.'<br>';
            }
        }

        $this->content         =  new stdClass;
        $this->content->text   = $contenido;
        $this->content->footer = 'Footer here...';
     
        return $this->content;
    }
}

