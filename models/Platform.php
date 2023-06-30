<?php
    include("../util/conexionDB/conexion.php");

    class Platform{
        private $id;
        private $name;

        public function __construct($id_platform=null , $plat_name=null)
        {
            if($id_platform != null){
                $this->id=$id_platform;
            }
            if($plat_name != null){
                $this->name=$plat_name;
            }
        }

        public function getAll(){
            $mysqli = conectar();
            $query = $mysqli->query("SELECT * FROM platform");
            $listData = [];
            foreach ($query as $item){
                $itemObject = new Platform($item['id_platform'], $item['plat_name']);
                array_push($listData, $itemObject);
//                echo "entro a for";
            }
            $mysqli->close();
            return $listData;
//            echo "entro a getall";
        }

        function store()
        {
            $platformCreated = false;
            $mysqli = conectar();

            //TODO: Comprobar que no existe otra plataforma con el mismo nombre antes de crear
//            if($resultInsert = $mysqli->query("INSERT INTO platform (name) VALUES ('$this->name') ")){
            if($resultInsert = $mysqli->query("INSERT INTO platform (plat_name) VALUES ('$this->name')")){
                $platformCreated = true;
            }
            $mysqli->close();
            return $platformCreated;
        }


            /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }
    }




