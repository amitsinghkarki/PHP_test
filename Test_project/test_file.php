<?php

// function changeDateFormat(array $dates): array
// {
//     $result = [];
//     foreach ($dates as $date) {

//         if (strlen($date) == '10') {
//             if (strpos($date, '/') == 4) {
//                 array_push($result, substr($date, 0, 4) . substr($date, 5, 2) . substr($date, 8, 2));
//             } else if (strpos($date, '/') == 2) {
//                 array_push($result, substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2));
//             } else if (strpos($date, '-') == 2) {
//                 array_push($result, substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2));
//             }
//         }

//     }

//     return $result;
// }

// $dates = changeDateFormat(["2010/03/30", "15/12/2016", "11-15-2012", "20130720"]);
// foreach ($dates as $date) {
//     echo $date . "\n";
// }

// class CategoryTree
// {
//     public $category_list = [];
//     public function addCategory(string $category, string $parent = null): void
//     {
//         if ($parent == null) {
//             if (empty($category_list[0])) {
//                 echo $category_list[0];
//                 $category_list[0][0] = $category;
//             } else {

//                 echo $category_list[0];
//                 // $category[0][count($category['0'])] = $category;
//             }
//         }
//         var_dump($category_list);
//         return;

//     }

//     public function getChildren(string $parent): array
//     {
//         return $category;
//     }
// }

// $c = new CategoryTree;
// $c->addCategory('A', null);
// $c->addCategory('B', null);

// $c->addCategory('B', 'A');
// $c->addCategory('C', 'A');
// // echo implode(',', $c->getChildren('A'));

// Working properly

// function sortByPriceAscending(string $jsonString): string
// {

//     function comparePrice($obj1, $obj2)
//     {
//         return $obj1->price > $obj2->price;
//     }

//     function compareName($obj1, $obj2)
//     {
//         return $obj1->name > $obj2->name;
//     }
//     $items = json_decode($jsonString);
//     //print_r($items);
//     usort($items, 'compareName');
//     usort($items, 'comparePrice');

//     //print_r($items);

//     return json_encode($items);
// }

// echo sortByPriceAscending('[{"name":"eggs","price":1},{"name":"apple","price":1},{"name":"coffee","price":9.99},{"name":"tea","price":9.99},{"name":"Gold","price":99.99},{"name":"rice","price":4.04}]');
