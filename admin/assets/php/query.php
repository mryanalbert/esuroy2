<?php

require_once 'db.php';

class Query extends Database
{
  // Fetch Admin through username
  public function fetchAdminUser($user)
  {
    $sql = "SELECT * FROM admin WHERE username = :user";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['user' => $user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  // Fetch Regions
  public function fetchRegions()
  {
    $sql = "SELECT * FROM regions";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  // Fetch Provinces Based on Regions
  public function fetchProvincesBasedOnRegion($regCode)
  {
    $sql = "SELECT * FROM provinces WHERE prov_reg_code = :regCode";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['regCode' => $regCode]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  // Fetch Cities Based on Provinces
  public function fetchCitiesBasedOnProvince($provCode)
  {
    $sql = "SELECT * FROM cities WHERE city_prov_code = :provCode";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['provCode' => $provCode]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  // Fetch Cities Based on Cities
  public function fetchBrgysBasedOnCity($cityCode)
  {
    $sql = "SELECT * FROM barangays WHERE brgy_city_code = :cityCode";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['cityCode' => $cityCode]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  // Add Mayor
  public function addMayor($uniqid, $fname, $mname, $lname, $dob, $gen, $pic)
  {
    $sql = "INSERT INTO mayors (mayor_uniqid, mayor_fname, mayor_mname, mayor_lname, mayor_dob, mayor_gen, mayor_pic)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$uniqid, $fname, $mname, $lname, $dob, $gen, $pic]);
    return true;
  }

  // Update city_mayor_uniqid column of cities table
  public function updateCityMayorUniqid($uniqid, $id)
  {
    $sql = "UPDATE cities SET city_mayor_uniqid = ? WHERE city_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$uniqid, $id]);
    return true;
  }

  // Fetch a city
  public function fetchCity($id)
  {
    $sql = "SELECT * FROM cities WHERE city_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  // Fetch Mayors Based on Provinces
  public function fetchMayorsBasedOnProvinces($provCode)
  {
    $sql = "SELECT * FROM cities 
            INNER JOIN mayors ON cities.city_mayor_uniqid = mayors.mayor_uniqid
            WHERE city_prov_code = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$provCode]);
    $result = $stmt->fetchAll();
    return $result;
  }

  // Fetch Mayor
  public function fetchMayor($uniqid)
  {
    $sql = "SELECT * FROM mayors WHERE mayor_uniqid = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$uniqid]);
    $result = $stmt->fetch();
    return $result;
  }

  // Update Mayor With Pic
  public function updateMayorWithPic($fname, $mname, $lname, $dob, $gen, $img, $id)
  {
    $sql = "UPDATE mayors
            SET mayor_fname = ?,
              mayor_mname = ?,
              mayor_lname = ?,
              mayor_dob = ?,
              mayor_gen = ?,
              mayor_pic = ?
            WHERE mayor_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$fname, $mname, $lname, $dob, $gen, $img, $id]);
    return true;
  }

  // Update Mayor Without Pic
  public function updateMayorWithoutPic($fname, $mname, $lname, $dob, $gen, $id)
  {
    $sql = "UPDATE mayors
            SET mayor_fname = ?,
              mayor_mname = ?,
              mayor_lname = ?,
              mayor_dob = ?,
              mayor_gen = ?
            WHERE mayor_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$fname, $mname, $lname, $dob, $gen, $id]);
    return true;
  }

  // Delete Mayor
  public function delMayor($uniqid)
  {
    $sql = "DELETE FROM mayors WHERE mayor_uniqid = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$uniqid]);
    return true;
  }

  // Fetch a barangay
  public function fetchBrgy($brgyCode)
  {
    $sql = "SELECT * FROM barangays WHERE brgy_code = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$brgyCode]);
    $result = $stmt->fetch();
    return $result;
  }

  // Add Captain
  public function addCaptain($uniqid, $pw, $fname, $mname, $lname, $dob, $gen, $pic)
  {
    $sql = "INSERT INTO captains (cap_uniqid, cap_pw, cap_fname, cap_mname, cap_lname, cap_dob, cap_gen, cap_pic)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$uniqid, $pw, $fname, $mname, $lname, $dob, $gen, $pic]);
    return true;
  }

  // Fetch Captains Based on Cities
  public function fetchCaptainsBasedOnCities($cityCode)
  {
    $sql = "SELECT * FROM barangays
            INNER JOIN captains 
              ON barangays.brgy_captain_uniqid = captains.cap_uniqid
            WHERE brgy_city_code = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$cityCode]);
    $result = $stmt->fetchAll();
    return $result;
  }

  // Update brgy_captain_uniqid column of barangays table
  public function updateBrgyCaptainUniqid($uniqid, $brgyCode)
  {
    $sql = "UPDATE barangays SET brgy_captain_uniqid = ? WHERE brgy_code = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$uniqid, $brgyCode]);
    return true;
  }

  // Delete Captain
  public function delCaptain($uniqid)
  {
    $sql = "DELETE FROM captains WHERE cap_uniqid = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$uniqid]);
    return true;
  }

  // Fetch Captain
  public function fetchCaptain($capId)
  {
    $sql = "SELECT * FROM captains WHERE cap_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$capId]);
    $result = $stmt->fetch();
    return $result;
  }

  // Update Captain with Pic
  public function updateBrgyCaptainWithPic($fname, $mname, $lname, $dob, $gen, $pic, $id)
  {
    $sql = "UPDATE captains 
            SET cap_fname = ?,
              cap_mname = ?,
              cap_lname = ?,
              cap_dob = ?,
              cap_gen = ?,
              cap_pic = ?
            WHERE cap_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$fname, $mname, $lname, $dob, $gen, $pic, $id]);
    return true;
  }

  // Update Captain without Pic
  public function updateBrgyCaptainWithoutPic($fname, $mname, $lname, $dob, $gen, $id)
  {
    $sql = "UPDATE captains 
            SET cap_fname = ?,
              cap_mname = ?,
              cap_lname = ?,
              cap_dob = ?,
              cap_gen = ?
            WHERE cap_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$fname, $mname, $lname, $dob, $gen, $id]);
    return true;
  }

  public function fetchSpotsBasedOnBrgys($brgyId) {
    $sql = "SELECT * FROM spots
            INNER JOIN barangays
              ON barangays.brgy_id = spots.spot_brgy_id
            WHERE barangays.brgy_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$brgyId]);
    $result = $stmt->fetchAll();
    return $result;
  }
  
  public function fetchSpot($spotId) {
    $sql = "SELECT * FROM barangays
            INNER JOIN spots
              ON barangays.brgy_id = spots.spot_brgy_id
            INNER JOIN captains
              ON captains.cap_uniqid = barangays.brgy_captain_uniqid
            INNER JOIN cities
              ON cities.city_code = barangays.brgy_city_code
            INNER JOIN provinces
              ON provinces.prov_code = barangays.brgy_prov_code
            INNER JOIN regions
              ON regions.reg_code = barangays.brgy_reg_code
            LEFT JOIN mayors
	            ON cities.city_mayor_uniqid = mayors.mayor_uniqid
            WHERE spot_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$spotId]);
    $result = $stmt->fetch();
    return $result;
  }
  
  public function fetchHotelsBasedOnCities($brgyId) {
    $sql = "SELECT * FROM barangays
            INNER JOIN hotels
              ON barangays.brgy_id = hotels.hotel_brgy_id
            WHERE barangays.brgy_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$brgyId]);
    $result = $stmt->fetchAll();
    return $result;
  }
  
  public function fetchHotel($hotelId) {
    $sql = "SELECT * FROM barangays
            INNER JOIN hotels
              ON barangays.brgy_id = hotels.hotel_brgy_id
            INNER JOIN captains
              ON captains.cap_uniqid = barangays.brgy_captain_uniqid
            INNER JOIN cities
              ON cities.city_code = barangays.brgy_city_code
            INNER JOIN provinces
              ON provinces.prov_code = barangays.brgy_prov_code
            INNER JOIN regions
              ON regions.reg_code = barangays.brgy_reg_code
            LEFT JOIN mayors
	            ON cities.city_mayor_uniqid = mayors.mayor_uniqid
            WHERE hotel_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$hotelId]);
    $result = $stmt->fetch();
    return $result;
  }

  public function fetchEventsBasedOnCities($eventId) {
    $sql = "SELECT * FROM events
            INNER JOIN barangays
              ON barangays.brgy_id = events.event_brgy_id
            WHERE events.event_brgy_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$eventId]);
    $result = $stmt->fetchAll();
    return $result;
  }

  public function fetchEvent($eventId) {
    $sql = "SELECT * FROM barangays
            INNER JOIN events
              ON barangays.brgy_id = events.event_brgy_id
            INNER JOIN captains
              ON captains.cap_uniqid = barangays.brgy_captain_uniqid
            INNER JOIN cities
              ON cities.city_code = barangays.brgy_city_code
            INNER JOIN provinces
              ON provinces.prov_code = barangays.brgy_prov_code
            INNER JOIN regions
              ON regions.reg_code = barangays.brgy_reg_code
            LEFT JOIN mayors
	            ON cities.city_mayor_uniqid = mayors.mayor_uniqid
            WHERE event_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$eventId]);
    $result = $stmt->fetch();
    return $result;
  }
}
