<?php
    interface IManage {
        public function view(int $page, string $search);
        public function add();
        public function save();
        public function delete();
    }
?>