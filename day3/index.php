<?php

// تسک روز سوم

require "function.php";


$students = [
    [
        "نام:" => "علی",
        "رشته:" => "حسابداری",
        "نمره:" => 19
    ],
    [
        "نام:" => "کیمیا",
        "رشته:" => "روانشناسی",
        "نمره:" => 17
    ],
    [
        "نام:" => "سارا",
        "رشته:" => "مهندسی عمران",
        "نمره:" => 15
    ],
    [
        "نام:" => "الهه",
        "رشته:" => "مهندسی کامپیوتر",
        "نمره:" => 11
    ],
    [
        "نام:" => "امیر",
        "رشته:" => "پزشکی",
        "نمره:" => 16
    ]
];


//میانگین نمرات دانشجویان

echo average($students);

echo "<br><br>";


//دانشجوهای با نمره ی بالای 15

$topStudents = score($students, 15);

foreach ($topStudents as $student) {

    echo $student["نام:"] . "<br>";

}

echo "<br>";


//نام دانشجوها 

$names = names($students);

foreach ($names as $name) {

    echo $name . "<br>";

}

echo "<br>";


// مرتب کردن دانشجوها بر اساس نمره

$sortedStudents = sort_score($students, "نمره:");


foreach ($sortedStudents as $student) {

    echo $student["نام:"] . " : " . $student["نمره:"] . "<br>";

}




?>