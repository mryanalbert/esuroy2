<?php
session_start();

require_once 'query.php';

$query = new Query();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['action'])) {
  // Admin Login
  if ($_POST['action'] == 'admin-login') {
    $user = $query->testInput($_POST['username']);
    $pass = $query->testInput($_POST['password']);

    $admin = $query->fetchAdminUser($user);

    if ($admin) {
      if ($admin['password'] == sha1($pass)) {
        $_SESSION['esuroy_admin'] = $admin['id'];
        echo json_encode($admin);
      } else {
        echo false;
      }
    } else {
      echo false;
    }
    return;
  }

  // Fetch Regions
  if ($_POST['action'] == 'fetchRegions') {
    echo json_encode($query->fetchRegions());
  }

  // Fetch Provinces Based On Region
  if ($_POST['action'] == 'fetchProvincesBasedOnRegion') {
    $regCode = $query->testInput($_POST['regCode']);
    echo json_encode($query->fetchProvincesBasedOnRegion($regCode));
  }

  // Fetch Cities Based On Province
  if ($_POST['action'] == 'fetchCitiesBasedOnProvince') {
    $provCode = $query->testInput($_POST['provCode']);
    echo json_encode($query->fetchCitiesBasedOnProvince($provCode));
  }

  // Fetch Barangays Based On Cities
  if ($_POST['action'] == 'fetchBrgysBasedOnCities') {
    $cityCode = $query->testInput($_POST['cityCode']);
    echo json_encode($query->fetchBrgysBasedOnCity($cityCode));
  }

  // Add Mayor
  if ($_POST['action'] == 'addMayor') {
    $city = $query->testInput($_POST['cities-form']);
    $fname = $query->testInput($_POST['fname']);
    $mname = $query->testInput($_POST['mname']);
    $lname = $query->testInput($_POST['lname']);
    $dob = $query->testInput($_POST['dob']);
    $gen = $query->testInput($_POST['gen']);
    $pic = $_FILES['pic'];
    $uniqid = uniqid();

    if ($query->fetchCity($city)['city_mayor_uniqid']) {
      echo 2;
      return;
    }

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      // Add Mayor with Image
      if ($query->addMayor($uniqid, $fname, $mname, $lname, $dob, $gen, $img)) {
        echo $query->updateCityMayorUniqid($uniqid, $city);
      }
    } else {
      // Add Mayor without Image
      if ($query->addMayor($uniqid, $fname, $mname, $lname, $dob, $gen, '')) {
        echo $query->updateCityMayorUniqid($uniqid, $city);
      }
    }
  }

  // Fetching Mayors Based on Province
  if ($_POST['action'] == 'fetchMayorsBasedOnProvinces') {
    $provCode = $query->testInput($_POST['provCode']);
    echo json_encode($query->fetchMayorsBasedOnProvinces($provCode));
  }

  // Delete Mayor
  if ($_POST['action'] == 'delMayor') {
    $uniqid = $query->testInput($_POST['uniqId']);
    $cityId = $query->testInput($_POST['cityId']);

    if ($query->delMayor($uniqid)) {
      echo $query->updateCityMayorUniqid(null, $cityId);
    }
  }

  // Fetch Mayor
  if ($_POST['action'] == 'fetchMayor') {
    $uniqid = $query->testInput($_POST['uniqId']);
    echo json_encode($query->fetchMayor($uniqid));
  }

  // Update Mayor
  if ($_POST['action'] == 'updateMayor') {
    $id = $query->testInput($_POST['edit-mayor-id']);
    $fname = $query->testInput($_POST['edit-fname']);
    $mname = $query->testInput($_POST['edit-mname']);
    $lname = $query->testInput($_POST['edit-lname']);
    $dob = $query->testInput($_POST['edit-dob']);
    $gen = $query->testInput($_POST['edit-gen']);
    $pic = $_FILES['edit-pic'];

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      echo $query->updateMayorWithPic($fname, $mname, $lname, $dob, $gen, $img, $id);
    } else {
      echo $query->updateMayorWithoutPic($fname, $mname, $lname, $dob, $gen, $id);
    }
  }

  // Add Captain
  if ($_POST['action'] == 'addCaptain') {
    $uniqid = uniqid();
    $brgyCode = $query->testInput($_POST['brgys-form']);
    $pw = substr(uniqid(), 0, 10);
    $fname = $query->testInput($_POST['fname']);
    $mname = $query->testInput($_POST['mname']);
    $lname = $query->testInput($_POST['lname']);
    $dob = $query->testInput($_POST['dob']);
    $gen = $query->testInput($_POST['gen']);
    $pic = $_FILES['pic'];

    if ($query->fetchBrgy($brgyCode)['brgy_captain_uniqid']) {
      echo 2;
      return;
    }

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      // Add Captain with Image
      if ($query->addCaptain($uniqid, $pw, $fname, $mname, $lname, $dob, $gen, $img)) {
        echo $query->updateBrgyCaptainUniqid($uniqid, $brgyCode);
      }
    } else {
      // Add Captain without Image
      if ($query->addCaptain($uniqid, $pw, $fname, $mname, $lname, $dob, $gen, '')) {
        echo $query->updateBrgyCaptainUniqid($uniqid, $brgyCode);
      }
    }
  }

  // Fetch Captains Based On Cities
  if ($_POST['action'] == 'fetchCaptainsBasedOnCities') {
    $cityCode = $query->testInput($_POST['cityCode']);
    echo json_encode($query->fetchCaptainsBasedOnCities($cityCode));
  }

  // Delete Captain
  if ($_POST['action'] == 'delCaptain') {
    $uniqid = $query->testInput($_POST['uniqId']);
    $brgyCode = $query->testInput($_POST['brgyCode']);

    if ($query->delCaptain($uniqid)) {
      echo $query->updateBrgyCaptainUniqid("", $brgyCode);
    }
  }

  // Fetch Captain
  if ($_POST['action'] == 'fetchCaptain') {
    $capId = $query->testInput($_POST['capId']);
    echo json_encode($query->fetchCaptain($capId));
  }

  // Update Captain
  if ($_POST['action'] == 'updateCaptain') {
    $id = $query->testInput($_POST['cap-id']);
    $fname = $query->testInput($_POST['edit-fname']);
    $mname = $query->testInput($_POST['edit-mname']);
    $lname = $query->testInput($_POST['edit-lname']);
    $dob = $query->testInput($_POST['edit-dob']);
    $gen = $query->testInput($_POST['edit-gen']);
    $pic = $_FILES['edit-pic'];

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      // Updating with image
      echo $query->updateBrgyCaptainWithPic($fname, $mname, $lname, $dob, $gen, $img, $id);
      return;
    }
    // Updating without image
    echo $query->updateBrgyCaptainWithoutPic($fname, $mname, $lname, $dob, $gen, $id);
  }

  // Fetch Spots Based on Cities
  if ($_POST['action'] == 'fetchSpotsBasedOnCities') {
    $brgyId = $query->testInput($_POST['id']);
    echo json_encode($query->fetchSpotsBasedOnBrgys($brgyId));
  }
  
  // Fetch Spot
  if ($_POST['action'] == 'fetchSpot') {
    $spotId = $query->testInput($_POST['spotId']);
    $spot = $query->fetchSpot($spotId);
    $spot['spot_caption'] = html_entity_decode($spot['spot_caption']);
    
    if ($spot['mayor_dob']) {
      $spot['mayor_dob'] = date('F d, Y', strtotime($spot['mayor_dob']));
    }
    
    if ($spot['cap_dob']) {
      $spot['cap_dob'] = date('F d, Y', strtotime($spot['cap_dob']));
    }

    echo json_encode($spot);
  }

  // Fetch Hotels Based on Cities
  if ($_POST['action'] == 'fetchHotelsBasedOnCities') {
    $brgyId = $query->testInput($_POST['id']);
    echo json_encode($query->fetchHotelsBasedOnCities($brgyId));
  }

  // Fetch Hotel
  if ($_POST['action'] == 'fetchHotel') {
    $hotelId = $query->testInput($_POST['hotelId']);
    $hotel = $query->fetchHotel($hotelId);
    $hotel['hotel_caption'] = html_entity_decode($hotel['hotel_caption']);

    if ($hotel['mayor_dob']) {
      $hotel['mayor_dob'] = date('F d, Y', strtotime($hotel['mayor_dob']));
    }
    
    if ($hotel['cap_dob']) {
      $hotel['cap_dob'] = date('F d, Y', strtotime($hotel['cap_dob']));
    }

    echo json_encode($hotel);
  }

  // Fetch Events Based on Cities
  if ($_POST['action'] == 'fetchEventsBasedOnCities') {
    $eventId = $query->testInput($_POST['eventId']);
    echo json_encode($query->fetchEventsBasedOnCities($eventId));
  }

  // Fetch Event
  if ($_POST['action'] == 'fetchEvent') {
    $eventId = $query->testInput($_POST['eventId']);
    $event = $query->fetchEvent($eventId);
    $event['event_caption'] = html_entity_decode($event['event_caption']);

    if ($event['mayor_dob']) {
      $event['mayor_dob'] = date('F d, Y', strtotime($event['mayor_dob']));
    }
    
    if ($event['cap_dob']) {
      $event['cap_dob'] = date('F d, Y', strtotime($event['cap_dob']));
    }

    echo json_encode($event);
  }
}
