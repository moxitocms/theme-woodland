<?php

namespace frontend\themes\woodland\widgets\leads\question;

use pantera\leads\models\Lead;

class LeadQuestion extends Lead
{
    public $name;
    public $phone;
    public $email;
    public $question;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['name', 'required'];
        $rules[] = ['phone', 'required'];
        $rules[] = ['email', 'required'];
        $rules[] = ['email', 'email'];
        $rules[] = ['question', 'required'];
        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['name'] = 'Имя';
        $labels['phone'] = 'Телефон';
        $labels['email'] = 'Email';
        $labels['question'] = 'Вопрос';
        return $labels;
    }
}
