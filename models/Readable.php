<?php

    abstract class Readable {
        protected $id;
        protected $title;
        protected $year;
        protected $avail;
        protected $cover;
        protected Shelf $shelf;

        function __construct(){

        }
        abstract protected function getDetails($id);

        protected function setShelf($id){
            $this->shelf = new Shelf($id);
        }



        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of title
         */
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Get the value of year
         */
        public function getYear()
        {
                return $this->year;
        }

        /**
         * Get the value of avail
         */
        public function getAvail()
        {
                return $this->avail;
        }

        /**
         * Get the value of cover
         */
        public function getCover()
        {
                return $this->cover;
        }
    }
?>