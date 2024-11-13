<?php

require_once 'src/classes/Student.php';
require_once 'src/classes/Teacher.php';

use Pemrograman\Student;
use Pemrograman\Teacher;

$student = new Student("Ali", 20, "A");
$teacher = new Teacher("Mr. Budi", 35, "Math");

$student->logAction("Student accessed.");
$teacher->logAction("Teacher accessed.");

echo $student . PHP_EOL;
echo $teacher . PHP_EOL;

?>
