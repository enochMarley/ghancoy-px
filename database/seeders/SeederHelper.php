<?php

namespace Database\Seeders;

use App\Enum\PersonnelType;

class SeederHelper
{
    /**
     * Helper method to get ranks for seeding
     */
    static function getRanks()
    {
        $ranks = [

            // Army offrs
            [
                "name" => "Second Lieutenant",
                "code" => "2/Lt",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Lieutenant",
                "code" => "Lt",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Captain",
                "code" => "Capt",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Major",
                "code" => "Maj",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Lieutenant Colonel",
                "code" => "Lt Col",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Colonel",
                "code" => "Col",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Brigadier General",
                "code" => "Brig Gen",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Major General",
                "code" => "Maj Gen",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Lieutenant General",
                "code" => "Lt Gen",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "General",
                "code" => "Gen",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Field Marshal",
                "code" => "Fld Msh",
                "type" => PersonnelType::OFFICER
            ],

            // Navy offrs
            [
                "name" => "Acting Sub Lieutenant",
                "code" => "A/Sub Lt",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Sub Lieutenant",
                "code" => "Sub Lt",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Naval Lieutenant",
                "code" => "Lt (GN)",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Lieutenant Commander",
                "code" => "Lt Cdr",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Commander",
                "code" => "Cdr",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Naval Captain",
                "code" => "Capt (GN)",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Commodore",
                "code" => "Cdre",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Rear Admiral",
                "code" => "Rear Adm",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Vice Admiral",
                "code" => "Vice Adm",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Admiral",
                "code" => "Adm",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => " Admiral of the Fleet",
                "code" => "Adm of the Fleet",
                "type" => PersonnelType::OFFICER
            ],

            // Air Force offrs
            [
                "name" => "Pilot Officer",
                "code" => "Pilot Offr",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Flying Officer",
                "code" => "Fg Offr",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Flight Lieutenant",
                "code" => "Flt Lt",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Squadron Leader",
                "code" => "Sqn Ldr",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Wing Commander",
                "code" => "Wng Comd",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Group Captain",
                "code" => "Gp Capt",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Air Commodore",
                "code" => "Air Cdr",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Air Vice Marshal",
                "code" => "AVM",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Air Marshal",
                "code" => "AM",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Air Chief Marshal",
                "code" => "ACM",
                "type" => PersonnelType::OFFICER
            ],
            [
                "name" => "Marshal of the Air Force",
                "code" => "MAF",
                "type" => PersonnelType::OFFICER
            ],


            //  Soldiers
            [
                "name" => "Private",
                "code" => "Pte",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Ordinary Seaman",
                "code" => "OS",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Aircraft Man",
                "code" => "AC ",
                "type" => PersonnelType::OTHER_RANK
            ],

            [
                "name" => "Signalman",
                "code" => "Sgmn",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Trooper",
                "code" => "Tpr",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Gunner",
                "code" => "Gnr",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Lance Corporal",
                "code" => "L/Cpl",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Lance Bombardier",
                "code" => "L/Bdr",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Able Seaman",
                "code" => "AB",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Leading Aircraft Man",
                "code" => "LAC",
                "type" => PersonnelType::OTHER_RANK
            ],

            [
                "name" => "Bombardier",
                "code" => "Bdr",
                "type" => PersonnelType::OTHER_RANK
            ],

            [
                "name" => "Corporal",
                "code" => "Cpl",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Leading Seaman",
                "code" => "LS",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Sergeant",
                "code" => "Sgt",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Petty Officer II",
                "code" => "PO II",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Flight Sergeant",
                "code" => "F/Sgt",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Staff Sergeant",
                "code" => "S/Sgt",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Petty Officer I",
                "code" => "PO I",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Warrant Officer II",
                "code" => "WO II",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Chief Petty Officer II",
                "code" => "CPO II",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Warrant Officer I",
                "code" => "WO I",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Chief Petty Officer I",
                "code" => "CPO I",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Senior Warrant Officer II",
                "code" => "SWO II",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Senior Warrant Officer I",
                "code" => "SWO I",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Fleet Chief Petty Officer II",
                "code" => "FCPO II",
                "type" => PersonnelType::OTHER_RANK
            ],
            [
                "name" => "Fleet Chief Petty Officer I",
                "code" => "FCPO I",
                "type" => PersonnelType::OTHER_RANK
            ],

            // Civ ranks
            [
                "name" => "Mister",
                "code" => "Mr",
                "type" => PersonnelType::CIVILIAN_EMPLOYEE
            ],
            [
                "name" => "Missus",
                "code" => "Mrs",
                "type" => PersonnelType::CIVILIAN_EMPLOYEE
            ],
            [
                "name" => "Miss",
                "code" => "Ms",
                "type" => PersonnelType::CIVILIAN_EMPLOYEE
            ],
            [
                "name" => "Doctor",
                "code" => "Dr",
                "type" => PersonnelType::CIVILIAN_EMPLOYEE
            ],

        ];

        return $ranks;
    }
}
