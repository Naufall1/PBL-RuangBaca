<?php

    abstract class Readable {
        protected $id;
        protected $title;
        protected int $year;
        protected $avail;
        protected $cover;
        protected Shelf $shelf;

        abstract protected function getDetails($id);
        abstract public function toJSON();

        public function setShelf($id){
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
        public function getYear(): int
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

        /**
         * Set the value of avail
         */
        public function setAvail($avail): self
        {
                $this->avail = $avail;

                return $this;
        }

        /**
         * Set the value of title
         */
        public function setTitle($title): self
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Set the value of year
         */
        public function setYear(int $year): self
        {
                $this->year = $year;

                return $this;
        }


        /**
         * Set the value of cover
         */
        public function setCover($cover): self
        {
                $this->cover = $cover;

                return $this;
        }
    }
?>