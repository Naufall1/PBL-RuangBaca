<?php
    class Flasher {
        public static function setFlash($message, $action, $type) {
            $_SESSION['flash'] = [
                'message' => $message,
                'action' => $action,
                'type' => $type
           ];
        }
        public static function flash() {
            if (isset($_SESSION['flash'])) {   
                echo "<script>alert(\'{$_SESSION['flash']['type']}\')</script>";
                if ($_SESSION['flash']['type'] === 'success') {
                    echo '<div id="inner-message" class="alert alert-custom alert-success-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex" style="gap: 12px; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                                    <rect width="48" height="48" fill="#14AE5C" rx="24"/>
                                    <path fill="#fff" d="M24 11.167c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.833 24 37.833c7.346 0 13.333-5.986 13.333-13.333S31.347 11.167 24 11.167Zm6.373 10.266-7.56 7.56a.999.999 0 0 1-1.413 0l-3.773-3.773a1.006 1.006 0 0 1 0-1.413 1.006 1.006 0 0 1 1.413 0l3.067 3.066 6.853-6.853a1.006 1.006 0 0 1 1.413 0 1.006 1.006 0 0 1 0 1.413Z"/>
                                </svg>
                                <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                                    <h4 class="heading-message">'.$_SESSION['flash']['action'].'</h4>
                                    <p class="content-message">'.$_SESSION['flash']['message'].'</p>
                                </div>
                            </div>
                            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                            </svg>
                            </a>
                        </div>
                    </div>';
                } else if ($_SESSION['flash']['type'] === 'warning'){
                    echo '<div id="inner-message" class="alert alert-custom alert-warning-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex" style="gap: 12px; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                                    <rect width="48" height="48" fill="#F1CB01" rx="24"/>
                                    <path fill="#fff" d="M24 11.167c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.833 24 37.833c7.346 0 13.333-5.986 13.333-13.333S31.347 11.167 24 11.167Zm-1 8c0-.547.453-1 1-1 .547 0 1 .453 1 1v6.666c0 .547-.453 1-1 1-.547 0-1-.453-1-1v-6.666Zm2.227 11.173c-.067.173-.16.307-.28.44a1.54 1.54 0 0 1-.44.28c-.16.067-.334.107-.507.107a1.32 1.32 0 0 1-.507-.107 1.54 1.54 0 0 1-.44-.28 1.376 1.376 0 0 1-.28-.44 1.327 1.327 0 0 1-.107-.507c0-.173.04-.346.107-.506.067-.16.16-.307.28-.44.133-.12.28-.214.44-.28a1.33 1.33 0 0 1 1.014 0c.16.066.306.16.44.28.12.133.213.28.28.44.066.16.106.333.106.506 0 .174-.04.347-.106.507Z"/>
                                </svg>
            
                                <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                                    <h4 class="heading-message">'.$_SESSION['flash']['action'].'</h4>
                                    <p class="content-message">'.$_SESSION['flash']['message'].'</p>
                                </div>
                            </div>
                            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                            </svg>
                            </a>
                        </div>
                    </div>';
                } else if ($_SESSION['flash']['type'] === 'danger') {
                    echo'<div id="inner-message" class="alert alert-custom alert-danger-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex" style="gap: 12px; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                                <rect width="48" height="48" fill="#E20000" rx="24"/>
                                <path fill="#fff" d="M24 10.667c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.333 24 37.333c7.346 0 13.333-5.986 13.333-13.333S31.347 10.667 24 10.667Zm4.48 16.4a1.006 1.006 0 0 1 0 1.413.99.99 0 0 1-.707.293.989.989 0 0 1-.706-.293L24 25.413l-3.067 3.067a.99.99 0 0 1-.706.293.99.99 0 0 1-.707-.293 1.006 1.006 0 0 1 0-1.413L22.587 24l-3.067-3.067a1.006 1.006 0 0 1 0-1.413 1.006 1.006 0 0 1 1.413 0L24 22.587l3.067-3.067a1.006 1.006 0 0 1 1.413 0 1.006 1.006 0 0 1 0 1.413L25.413 24l3.067 3.067Z"/>
                            </svg>
                                <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                                    <h4 class="heading-message">'.$_SESSION['flash']['action'].'</h4>
                                    <p class="content-message">'.$_SESSION['flash']['message'].'</p>
                                </div>
                            </div>
                            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                            </svg>
                            </a>
                        </div>
                    </div>';
                }
            }
        }
    }
?>