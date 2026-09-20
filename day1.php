<?php
$number = 2;

// تشخیص زوج یا فرد بودن عدد

if ($number %2 == 0){
    echo "the number is even";
}
else{
    echo"the number is odd";
}
echo "<br><br><br><br>";



// تشخیص اول بودن یا نبودن عدد
$isPrime = true;

if ($number < 2) {
    $isPrime = false;
}
else{
    for ($i=2; $i<$number; $i++){
        if($number %$i == 0){
        $isPrime = false;
        break;
        }
    
}
}
if ($isPrime) {
    echo "The number is prime";
}
else{
    echo "The number is NOT prime";
}
echo "<br><br><br>";


// جدول ضرب عدد در اعداد ۱ تا ۱۰ 

for ($i=1; $i<11; $i++){
    echo "$number × $i = ". ($number*$i) . "<br>";

}
echo "<br><br><br><br>";




$string = "my name is Mahdieh Mobaraki";

// تعداد حروف / کاراکترها

echo strlen($string). "<br>";

// تعداد کلمات

echo str_word_count($string). "<br>";

//برعکس رشته 

echo strrev($string);

?>