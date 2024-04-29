<?php

require_once 'db.php';

class Query extends Database
{
  // Fetch Captain through password
  public function fetchCaptainUser($pw)
  {
    $sql = "SELECT * FROM captains WHERE cap_pw = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$pw]);
    $row = $stmt->fetch();
    return $row;
  }

  // Fetch Captain through password
  public function fetchCaptainInfo($id)
  {
    $sql = "SELECT * FROM captains
            INNER JOIN barangays
              ON captains.cap_uniqid = barangays.brgy_captain_uniqid
            INNER JOIN cities
              ON barangays.brgy_city_code = cities.city_code
            INNER JOIN provinces
              ON cities.city_prov_code = provinces.prov_code
            INNER JOIN regions
              ON provinces.prov_reg_code = regions.reg_code
            WHERE cap_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    return $row;
  }

  // Fetch Tourist Spots Based on Barangay
  public function fetchSpotsBasedOnBrgy($brgyId)
  {
    $sql = "SELECT * FROM spots
            INNER JOIN barangays
              ON spots.spot_brgy_id = barangays.brgy_id
            WHERE spot_brgy_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$brgyId]);
    $result = $stmt->fetchAll();
    return $result;
  }

  // Add Spot
  public function addSpot($name, $content, $pic, $brgyId)
  {
    $sql = "INSERT INTO spots (spot_name, spot_caption, spot_main_img, spot_brgy_id)
            VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $content, $pic, $brgyId]);
    return true;
  }

  // Fetch Tourist Spot
  public function fetchSpot($id)
  {
    $sql = "SELECT * FROM spots WHERE spot_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  // Update Tourist Spot with Image
  public function updateSpotWithImage($id, $name, $content, $pic)
  {
    $sql = "UPDATE spots
            SET spot_name = ?,
              spot_caption = ?,
              spot_main_img = ?
            WHERE spot_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $content, $pic, $id]);
    return true;
  }

  // Update Tourist Spot without Image
  public function updateSpotWithoutImage($id, $name, $content)
  {
    $sql = "UPDATE spots
            SET spot_name = ?,
              spot_caption = ?
            WHERE spot_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $content, $id]);
    return true;
  }

  // Delete Spot
  public function delSpot($id)
  {
    $sql = "DELETE FROM spots WHERE spot_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    return true;
  }

  // Fetch Hotels Based on Barangay
  public function fetchHotelsBasedOnBrgy($brgyId)
  {
    $sql = "SELECT * FROM hotels
            INNER JOIN barangays
              ON hotels.hotel_brgy_id = barangays.brgy_id
            WHERE hotel_brgy_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$brgyId]);
    $result = $stmt->fetchAll();
    return $result;
  }

  // Add Hotel
  public function addHotel($name, $street, $brgyId, $offersMeal, $content, $pic)
  {
    $sql = "INSERT INTO hotels (hotel_name, hotel_street, hotel_brgy_id, hotel_offers_meal, hotel_caption, hotel_main_img)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $street, $brgyId, $offersMeal, $content, $pic]);
    return true;
  }

  // Fetch Hotel
  public function fetchHotel($id)
  {
    $sql = "SELECT * FROM hotels WHERE hotel_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  // Delete Hotel
  public function delHotel($id)
  {
    $sql = "DELETE FROM hotels WHERE hotel_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    return true;
  }

  // Update Hotel With Image
  public function updateHotelWithImage($name, $street, $offersMeal, $content, $pic, $id)
  {
    $sql = "UPDATE hotels
            SET hotel_name = ?,
              hotel_street = ?,
              hotel_offers_meal = ?,
              hotel_caption = ?,
              hotel_main_img = ?
            WHERE hotel_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $street, $offersMeal, $content, $pic, $id]);
    return true;
  }

  // Update Hotel Without Image
  public function updateHotelWithoutImage($name, $street, $offersMeal, $content, $id)
  {
    $sql = "UPDATE hotels
            SET hotel_name = ?,
              hotel_street = ?,
              hotel_offers_meal = ?,
              hotel_caption = ?
            WHERE hotel_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $street, $offersMeal, $content, $id]);
    return true;
  }

  // Fetch Events Based on Barangay
  public function fetchEventsBasedOnBrgy($brgyId)
  {
    $sql = "SELECT * FROM events
            INNER JOIN barangays
              ON events.event_brgy_id = barangays.brgy_id
            WHERE event_brgy_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$brgyId]);
    $result = $stmt->fetchAll();
    return $result;
  }

  // Add Event
  public function addEvent($name, $brgyId, $content)
  {
    $sql = "INSERT INTO events (event_name, event_brgy_id, event_caption) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $brgyId, $content]);
    return true;
  }

  // Fetch Event
  public function fetchEvent($id)
  {
    $sql = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  // Delete Event
  public function delEvent($id)
  {
    $sql = "DELETE FROM events WHERE event_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    return true;
  }

  // Update Event
  public function updateEvent($name, $content, $id)
  {
    $sql = "UPDATE events
            SET event_name = ?,
              event_caption = ?
            WHERE event_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name, $content, $id]);
    return true;
  }
}
