<?php
function getRatingCount($rating_string)
{
   $rating_string = strtolower(trim($rating_string));
   switch ($rating_string) 
   {
      case "1 star":
         $rating_count = 1;
        break;
        case "1 stars":
         $rating_count = 1;
        break;
        case "1 star and a half":
         $rating_count = 1.5;
        break;
        case "1 stars and a half":
         $rating_count = 1.5;
        break;

        case "2 stars":
         $rating_count = 2;
        break;
        case "2 stars and a half":
         $rating_count = 2.5;
        break;

        case "3 stars":
         $rating_count = 3;
        break;
        case "3 stars and a half":
         $rating_count = 3.5;
        break;

        case "4 stars":
         $rating_count = 4;
        break;
        case "4 stars and a half":
         $rating_count = 4.5;
        break;

        case "5 stars":
         $rating_count = 5;
        break;

      default:
      $rating_count = 0;
   }
return $rating_count;
}

function getFacilities($faclitiyObj){
   $outerFacilityArr = [];
   foreach ($faclitiyObj as $key => $facility) {
      
      if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 320 && $facility->facilityGroupCode == 70)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 550 && $facility->facilityGroupCode == 70)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 280 && $facility->facilityGroupCode == 70)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }
      else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 40 && $facility->facilityGroupCode == 80)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 295 && $facility->facilityGroupCode == 90)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }
   }

   return $outerFacilityArr;
}

function showRooms($rooms)
{

   $allRooms = [];
   $singlebedArr = [];
   $doublebedArr = [];
   $allTypesRooms = [];
   $queensizebed = [];
   foreach ($rooms as $key => $room) {

      // Single bed 80-130 width
      if(isset($room->roomStays[0]->roomStayFacilities[0]->facilityCode) && !empty($room->roomStays[0]->roomStayFacilities[0]->facilityCode) && isset($room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode) && !empty($room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode) && $room->roomStays[0]->roomStayFacilities[0]->facilityCode == 1 && $room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode == 61)
      {
         $singlebedArr[] = $room;

      }
      //  Double bed 131-150 width
      else if(isset($room->roomStays[0]->roomStayFacilities[0]->facilityCode) && !empty($room->roomStays[0]->roomStayFacilities[0]->facilityCode) && isset($room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode) && !empty($room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode) && $room->roomStays[0]->roomStayFacilities[0]->facilityCode == 150 && $room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode == 61)
      {
         $doublebedArr[] = $room;
      }
      // Queen-size bed 150-154 width
      else if(isset($room->roomStays[0]->roomStayFacilities[0]->facilityCode) && !empty($room->roomStays[0]->roomStayFacilities[0]->facilityCode) && isset($room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode) && !empty($room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode) && $room->roomStays[0]->roomStayFacilities[0]->facilityCode == 294 && $room->roomStays[0]->roomStayFacilities[0]->facilityGroupCode == 61)
      {
         $queensizebed[] = $room;
      }
      // rest all types rooms
      else{
         $allTypesRooms[] = $room;
      }
   }

   //0 = 'Single bed 80-130 width'
   //1 = 'Double bed 131-150 width'
   // 2 = 'Queen-size bed 150-154 width'
   // 3 = all types
   $allRooms[0] = $singlebedArr;
   $allRooms[1] = $doublebedArr;
   $allRooms[2] = $queensizebed;
   $allRooms[3] = $allTypesRooms;
   //echo '<pre>';
      //print_r($allRooms);die;

      return $allRooms;
}


function getRoomFacilities($roomFacilities)
{
   $outerFacilityArr = [];
   foreach ($roomFacilities as $key => $facility) {
      
      if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 261 && $facility->facilityGroupCode == 60)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }
      else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 287 && $facility->facilityGroupCode == 60)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }
      else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 289 && $facility->facilityGroupCode == 60)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }
      else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 100 && $facility->facilityGroupCode == 60)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }
      else if(isset($facility->facilityCode) && isset($facility->facilityGroupCode) && $facility->facilityCode == 10 && $facility->facilityGroupCode == 60)
      {
         if(isset($facility->description->content) && !empty($facility->description->content))
         {
            $outerFacilityArr[] = $facility->description->content;
         }
      }
   }

   return $outerFacilityArr;

}


