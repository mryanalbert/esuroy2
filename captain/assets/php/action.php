<?php
session_start();

require_once 'query.php';

$query = new Query();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['action'])) {
  // Captain Login
  if ($_POST['action'] == 'captain-login') {
    $pass = $query->testInput($_POST['capt-pass']);

    $captain = $query->fetchCaptainUser($pass);

    if ($captain) {
      $_SESSION['esuroy_captain'] = $captain['cap_id'];
      echo json_encode($captain);
    } else {
      echo false;
    }
    return;
  }

  // Fetch Spots Based On Barangay
  if ($_POST['action'] == 'fetchSpots') {
    $brgyId = $query->testInput($_POST['brgyId']);
    echo json_encode($query->fetchSpotsBasedOnBrgy($brgyId));
  }

  // Add Spot
  if ($_POST['action'] == 'addSpot') {
    $name = $query->testInput($_POST['spot-name']);
    $content = $query->testInput($_POST['spot-content']);
    $brgyId = $query->testInput($_POST['brgyId']);
    $pic = $_FILES['pic'];

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      echo $query->addSpot($name, $content, $img, $brgyId);
    } else {
      echo $query->addSpot($name, $content, '', $brgyId);
    }
  }

  // Fetch Spot
  if ($_POST['action'] == 'fetchSpot') {
    $spotId = $query->testInput($_POST['spotId']);
    $spot = $query->fetchSpot($spotId);
    $spot['spot_caption'] = html_entity_decode($spot['spot_caption']);
    echo json_encode($spot);
  }

  // Update Spot
  if ($_POST['action'] == 'updateSpot') {
    $id = $query->testInput($_POST['edit-spot-id']);
    $name = $query->testInput($_POST['edit-spot-name']);
    $content = $query->testInput($_POST['edit-spot-content']);
    $pic = $_FILES['edit-pic'];

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      echo $query->updateSpotWithImage($id, $name, $content, $img);
    } else {
      echo $query->updateSpotWithoutImage($id, $name, $content);
    }
  }

  // Delete Spot
  if ($_POST['action'] == 'delSpot') {
    $id = $query->testInput($_POST['spotId']);
    echo $query->delSpot($id);
  }

  // Fetch Hotels
  if ($_POST['action'] == 'fetchHotels') {
    $brgyId = $query->testInput($_POST['brgyId']);
    echo json_encode($query->fetchHotelsBasedOnBrgy($brgyId));
  }

  // Add Hotel
  if ($_POST['action'] == 'addHotel') {
    $name = $query->testInput($_POST['hotel-name']);
    $street = $query->testInput($_POST['street']);
    $offersMeal = $query->testInput($_POST['offer-meal']);
    $pic = $_FILES['pic'];
    $content = $query->testInput($_POST['hotel-content']);
    $brgyId = $query->testInput($_POST['brgyId']);

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      echo $query->addHotel($name, $street, $brgyId, $offersMeal, $content, $img);
    } else {
      echo $query->addHotel($name, $street, $brgyId, $offersMeal, $content, '');
    }
  }

  // Fetch Hotel
  if ($_POST['action'] == 'fetchHotel') {
    $id = $query->testInput($_POST['hotelId']);
    $hotel = $query->fetchHotel($id);
    $hotel['hotel_caption'] = html_entity_decode($hotel['hotel_caption']);
    echo json_encode($hotel);
  }

  // Update Hotel
  if ($_POST['action'] == 'updateHotel') {
    $id = $query->testInput($_POST['edit-id']);
    $name = $query->testInput($_POST['edit-hotel-name']);
    $street = $query->testInput($_POST['edit-street']);
    $offersMeal = $query->testInput($_POST['edit-offer-meal']);
    $content = $query->testInput($_POST['edit-hotel-content']);
    $pic = $_FILES['edit-pic'];

    if (isset($pic['name']) && $pic['name'] != null) {
      $img = $pic['name'];
      move_uploaded_file($pic['tmp_name'], '../img/' . $img);

      echo $query->updateHotelWithImage($name, $street, $offersMeal, $content, $img, $id);
    } else {
      echo $query->updateHotelWithoutImage($name, $street, $offersMeal, $content, $id);
    }
  }

  // Delete Hotel
  if ($_POST['action'] == 'delHotel') {
    $id = $query->testInput($_POST['hotelId']);
    echo $query->delHotel($id);
  }

  // Fetch Events
  if ($_POST['action'] == 'fetchEvents') {
    $brgyId = $query->testInput($_POST['brgyId']);
    echo json_encode($query->fetchEventsBasedOnBrgy($brgyId));
  }

  // Add Event
  if ($_POST['action'] == 'addEvent') {
    $name = $query->testInput($_POST['event-name']);
    $content = $query->testInput($_POST['event-content']);
    $brgyId = $query->testInput($_POST['brgyId']);
    echo $query->addEvent($name, $brgyId, $content);
  }

  // Delete Event
  if ($_POST['action'] == 'delEvent') {
    $id = $query->testInput($_POST['eventId']);
    echo $query->delEvent($id);
  }

  // Fetch Event
  if ($_POST['action'] == 'fetchEvent') {
    $id = $query->testInput($_POST['eventId']);
    $event = $query->fetchEvent($id);
    $event['event_caption'] = html_entity_decode($event['event_caption']);
    echo json_encode($event);
  }

  // Update Event
  if ($_POST['action'] == 'updateEvent') {
    $id = $query->testInput($_POST['edit-id']);
    $name = $query->testInput($_POST['edit-event-name']);
    $content = $query->testInput($_POST['edit-event-content']);

    echo $query->updateEvent($name, $content, $id);
  }
}
