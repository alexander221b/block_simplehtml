<?php
//configura la opción de activar o desactivar mostrar los cursos en el block
if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configcheckbox('block_simplehtml/showcourses',
                   get_string('showcourses', 'block_simplehtml'),
                   get_string('showcoursesdesc', 'block_simplehtml'),
                   0));
}