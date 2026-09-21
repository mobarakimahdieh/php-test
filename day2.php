<?php
// تمرین

// $number = 24;
// $isprime = true;

// for($i=2; $i<$number; $i++){
//     if($number % $i == 0){
//         $isprime = false;
//         break;
//     }
//     else{
//         $isprime = true;
//     }
// }
// if ($isprime){
//     echo "prime";
//     }
//     else{
//     echo "NOT prime";
//     }


// $number = 583921;
// $count = 0;
// for($i=$number; $i>0;){
//     $i = intdiv($i , 10);
//     $count+=1;
// }
// echo $count;


// $number = 583921;
// $result =[];
// for($i=$number; $i>0;){
//     $i = $i%10;
//     $result= $i;
// }






// تسک روز دوم

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

$total = 0;
foreach($students as $student){
    $total+=$student["نمره:"];
}
echo "میانگین نمرات دانشجویان: ".($total/count($students));
echo "<br><br><br>";



//دانشجوهای با نمره ی بالای 15

function top15($student) {
    return $student["نمره:"] > 15;
}
$result = array_filter($students,"top15");
echo " :دانشجوهای با نمره ی بالای 15". "<br>";
foreach ($result as $student) {
    echo $student["نام:"] . "<br>";
}
echo "<br><br><br>";


//نام دانشجوها 


// foreach ($students as $student) {
//     echo $student["نام:"] . "<br>";
// }


$names = array_map(function ($student) {
    return $student["نام:"];
}, $students);

echo "نام دانشجوها: ". "<br>";

foreach ($names as $name) {
    echo $name . "<br>";
}
echo "<br><br><br>";



// مرتب کردن دانشجوها بر اساس نمره


usort($students, function ($student1, $student2) {
    return $student1["نمره:"] <=> $student2["نمره:"];
});

echo "دانشجوها بر اساس نمره:". "<br>";

foreach ($students as $student) {
    echo $student["نام:"] . " - " . $student["نمره:"] . "<br>";
}

?>