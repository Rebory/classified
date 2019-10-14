<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * @param int $length
 * @return string
 */
function generateRandomName($length = 16)
{
    return bin2hex(openssl_random_pseudo_bytes($length));
}

/**
 * @param $request
 * @param $path
 * @param $controlName
 * @return string
 */
function fileUpload($request, $path, $controlName)
{

    $file = $request->file($controlName);
    $fileName = generateRandomName('10') .".".$file->getClientOriginalExtension();
    $path = public_path($path);
    $fullPath = $path . $fileName;
    $file->move($path, $fullPath);
    return $fileName;
}


//
//function getMenuCategories()
//{
//    $result = [];
//    $categories = Category::where('status', 1)->get([
//        'id',
//        'category_name',
//        'pid',
//        'cat_slug'
//    ]);
//
//    if($categories->count() > 0) {
//        $result = buildTree($categories->toArray());
//    }
//    return $result;
//}
//
//
//function buildTree(array $elements, $parentId = 0) {
//    $branch = [];
//    foreach ($elements as $element) {
//        if ($element['pid'] == $parentId) {
//            $children = buildTree($elements, $element['id']);
//            if ($children) {
//                $element['children'] = $children;
//            }
//            $branch[] = $element;
//        }
//    }
//    return $branch;
//}



/**
 * @param $request
 * @return array
 */
function getFormData($request)
{
    $inputs = [];
    $data = $request->all();
    parse_str($data['form-data'], $inputs);
    return $inputs;
}

/**
 * @param $validator
 * @return array
 */
function parseErrorMessagesForAjaxForm($validator)
{
    $errors = [];

    if($validator->errors()->getMessages()) {
        foreach($validator->errors()->getMessages() as $key => $value) {
            $errors[] =  $value[0];

        }
    }
    return $errors;
}

/**
 * @param $errors
 * @return string
 */
function jsonErrors($errors)
{
    $err = [];
    if(count($errors) > 0) {
        foreach($errors as $key => $error) {
            $err[$key] = $error;
        }
    }
    echo json_encode(['status' => false, 'errors' => $err]);
}

/**
 * @param $errors
 * @param bool $validationError
 * @return array
 */
function generateValidationErrorsForAjaxSubmit($errors, $validationError = true)
{
    $response = [];
    $errors = ($validationError == true) ? $errors->getMessages() : $errors;
    if(count($errors) > 0) {
        foreach($errors as $key => $error) {
            $response[] = [
                'key' => $key,
                'error' => $error[0]
            ];
        }
    }

    return $response;
}


/**
 * @param int $status
 * @return string
 */
function displayStatus($status = 0)
{
    $render = "<div class = 'label label-danger'> InActive </div>";
    if($status) {
        $render = "<div class = 'label label-success'> Active </div>";
    }
    return $render;
}

/**
 * @param $prop
 * @return string
 */
function displayProp($prop)
{
    return ($prop != '') ? $prop : 'N/A';
}




/**
 * @param $length
 * @return string
 */
function randomName($length) {
    return bin2hex(openssl_random_pseudo_bytes($length));
}


/**
 * @param $message
 * @param bool $type
 */
function jsonSuccess($message, $type = false)
{
    echo json_encode(['status' => true, 'errors' => [], 'message' => $message, 'type' => $type]);
}

/**
 * @param $message
 */
function jsonSingleError($message)
{
    echo json_encode(['status' => false, 'message' => $message]);
}

/**
 * @param $message
 * @return string
 */
function jsonAjaxSuccess($message = null)
{
    $response = ['status' => true];
    if($message) {
        $response['message'] = $message;
    }
    return json_encode($response);
}

/**
 * @return array
 */
function commissionList() {
    return [
        null => '-- select --',
        5 => '5%',
        6 => '6%',
        7 => '7%',
        8 => '8%',
        9 => '9%',
        10 => '10%',
        11 => '11%',
        12 => '12%',
        13 => '13%',
        14 => '14%',
        15 => '15%',
        16 => '16%',
        17 => '17%',
        18 => '18%',
        19 => '19%',
        20 => '20%',
    ];
}


/**
 * @return array
 */
function yesNo() {
    return [
        null  => '-- select --',
        'No'  => 'No',
        'Yes' => 'Yes',
    ];
}

/**
 * @return array
 */
function minStayRequired() {
    return [
        null => '-- select --',
        1=> '1 Day',
        2=> '2 Days',
        3=> '3 Days',
        4=> '4 Days',
        5=> '5 Days',
        6 => '6 Days',
        7 => '7 Days',
        8 => '8 Days',
        9 => '9 Days',
        10 => '10 Days',
    ];
}

/**
 * @return array
 */
function applicableTaxes() {
    return [
        null => '-- select --',
        '13' => 'HST',
        '0'  => 'MAT',
        '0'  => 'OTHERS',
    ];
}

/**
 * @param $totalPrice
 * @param int $tax
 * @return float|int
 */
function calculateTax($totalPrice, $tax=13 )
{
    return $totalPrice/100*$tax;
}

/**
 * @return array
 */
function maxPeoplePerRoom() {
    return [
        null => '-- select --',
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
    ];
}
/**
 * @return array
 */
function cityCommissionList() {
    return [
        null => '-- select --',
        0 => 'N/A',
        5 => 'Yes 5%',
        6 => 'Yes 6%',
        7 => 'Yes 7%',
        8 => 'Yes 8%',
        9 => 'Yes 9%',
        10 => 'Yes 10%',
        11 => 'Yes 11%',
        12 => 'Yes 12%',
        13 => 'Yes 13%',
        14 => 'Yes 14%',
        15 => 'Yes 15%',
        16 => 'Yes 16%',
        17 => 'Yes 17%',
        18 => 'Yes 18%',
        19 => 'Yes 19%',
        20 => 'Yes 20%',
    ];
}



/**
 * @return false|string
 */
function nowDate()
{
    $now_date = Carbon::now()->toDateString();
    return $my_date = dateFormat($now_date);
}


/**
 * @param $date
 * @param string $format
 * @return false|string
 */
function dateSlashFormat($date, $format = 'm/d/Y')
{
    return date($format, strtotime($date));
}


function dateTimeFormat($date, $format = 'Y-m-d H:i')
{
    return date($format, strtotime($date));
}
/**
 * @param $date
 * @param string $format
 * @return false|string
 */
function dateFormat($date, $format = 'Y-m-d')
{
    return date($format, strtotime($date));
}


/**
 * @param $time
 * @param string $format
 * @return false|string
 */
function timeFormat($time, $format = 'H:i')
{
    return date($format, strtotime($time));
}
/**
 * @param $date
 * @param string $format
 * @return false|string
 */
function dateHuman($date, $format = 'F j, Y')
{
    return date($format, strtotime($date));
}


function timeHuman($time, $format = 'H:i A')
{
    return date($format, strtotime($time));
}


function dateTimeHuman($date, $format = 'F j, Y H:i A')
{
    return date($format, strtotime($date));
}


/**
 * @return array
 */
function ratingList() {
    return [
        null => '-- select --',
        1 => '1 Star',
        2 => '2 Star',
        3 => '3 Star',
        4 => '4 Star',
        5 => '5 Star',
    ];
}


/**
 * @return array
 */
function countList() {
    return [
        null => '0',
        1 => '1',
        2 => '2',
        3 => '3',
    ];
}

function dateFormatForTimer($date, $format = 'Y/d/m')
{
    return date($format, strtotime($date));
}

/**
 * @param null $string
 * @return string
 */
function lower_slug($string= null)
{
    return Str::slug($string);
}


/**
 * @return array
 */
function numericList50() {
    return [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
        13 => '13',
        14 => '14',
        15 => '15',
        16 => '16',
        17 => '17',
        18 => '18',
        19 => '19',
        20 => '20',
        21 => '21',
        22 => '22',
        23 => '23',
        24 => '24',
        25 => '25',
        26 => '26',
        27 => '27',
        28 => '28',
        29 => '29',
        30 => '30',
        31 => '31',
        32 => '32',
        33 => '33',
        34 => '34',
        35 => '35',
        36 => '36',
        37 => '37',
        38 => '38',
        39 => '39',
        40 => '40',
        41 => '41',
        42 => '42',
        43 => '43',
        44 => '44',
        45 => '45',
        46 => '46',
        47 => '47',
        48 => '48',
        49 => '49',
        50 => '50',
    ];
}

