<?php




function average(array $students): float
{
    $totalScore = 0;

    foreach ($students as $student) {
        $totalScore += $student["نمره:"];
    }

    return $totalScore / count($students);
}



function score(array $students, int $score): array
{
    return array_filter($students, function ($student) use ($score) {

        return $student["نمره:"] > $score;

    });
}



function names(array $students): array
{
    return array_map(function ($student) {

        return $student["نام:"];

    }, $students);
}



function sort_score(array $students, string $field): array
{
    usort($students, function ($a, $b) use ($field) {

        return $a[$field] <=> $b[$field];

    });

    return $students;
}

?>