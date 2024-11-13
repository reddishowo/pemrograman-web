<?php

namespace Pemrograman;

require_once __DIR__ . '/../traits/LoggingTrait.php';
require_once 'Person.php';

class Teacher extends Person {
    use LoggingTrait;

    private $subject;

    public function __construct($name, $age, $subject) {
        parent::__construct($name, $age);
        $this->subject = $subject;
    }

    public function getDetails() {
        return "Name: $this->name, Age: $this->age, Subject: $this->subject";
    }
}
