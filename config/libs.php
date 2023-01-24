<?php
    $kelas_list = [
        [
            "id"          => "7BA943AF84838",
            "name"        => "petruk",
            "price"       => 5000,
            "quota"       => 30,
            "description" => "",
            "color"       => "bronze"
        ],
        [
            "id"          => "71A4AF1E2485B",
            "name"        => "bagong",
            "price"       => 20000,
            "quota"       => 25,
            "description" => "",
            "color"       => "silver"
        ],
        [
            "id"          => "68CCD993BCE2C",
            "name"        => "semar",
            "price"       => 100000,
            "quota"       => 20,
            "description" => "",
            "color"       => "gold"
        ],
        [
            "id"          => "8FFD7F9CA5F68",
            "name"        => "gareng",
            "price"       => 500000,
            "quota"       => 15,
            "description" => "",
            "color"       => "diamond"
        ],
    ];

    $domisili_list = array(
        1 => "Pulau Jawa",
        2 => "Pulau Sumatra",
        3 => "Pulau Nusa Tenggara",
        4 => "Pulau Kalimantan",
        5 => "Pulau Sulawesi",
        6 => "Pulau Maluku",
        7 => "Pulau Papua"
    );

    // Libs Functions
    function rupiah( $angka ) {
        if( $angka == 0 ) {
            return "Rp0";
        }

        $hasil = "Rp" . number_format( $angka, 0, ',', '.' );
        return $hasil;
    }

    // Find Array by ID
    function findKelasByID( $id, $array ) {
        foreach( $array as $key => $value ) {
            if( $value['id'] === $id ) {
                return $value;
            }
        }

        return null;
    }

    // Find Array by Name 
    function findKelasByName( $name, $array ) {
        foreach( $array as $key => $value ) {
            if( $value['name'] === $name ) {

                return $value;
            }
        }
        
        return null;
    }

    // Find Last Array ID Array
    function findKelasLastID( $array ) {
        $last = end( $array );

        return $last['id'];
    }
?>