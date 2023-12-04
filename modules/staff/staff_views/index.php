<body>
    <!-- Start: Fixed Layer -->
    <div class="fixed-layer d-flex">
        <!-- Start: Sidebar Menu -->

        <?php
        $template->sidebar();
        ?>

        <!-- End: Sidebar Menu -->


        <!-- Start: NAVBAR -->
        <div class="container-nav d-flex">

            <div class="d-flex align-items-center">


                <!-- Start: Logo -->
                <a href="#" class="d-flex logo">
                    <svg class="logo-ruangbaca" xmlns="http://www.w3.org/2000/svg" width="134" height="28" fill="none">
                        <path d="M21.401 12.289a3.837 3.837 0 0 0-1.1 3.075l-.019-.019a4.555 4.555 0 0 1-2.983 4.668 4.574 4.574 0 0 1-1.954.261l.02.019a3.873 3.873 0 0 0-3.86 2.204 3.857 3.857 0 0 0 .767 4.373 3.87 3.87 0 0 0 6.585-3.093l.02.019a4.555 4.555 0 0 1 2.983-4.668 4.575 4.575 0 0 1 1.954-.261l-.02-.019a3.868 3.868 0 0 0 3.405-1.488 3.85 3.85 0 0 0-2.227-6.115 3.867 3.867 0 0 0-3.568 1.044h-.003Zm-7.758 5.528-.02-.02a3.826 3.826 0 0 0 3.082-1.096 3.812 3.812 0 0 0 1.1-3.076l.02.019a4.554 4.554 0 0 1 1.322-3.61 4.57 4.57 0 0 1 3.615-1.319l-.02-.019a3.872 3.872 0 0 0 3.862-2.202 3.857 3.857 0 0 0-.765-4.374 3.87 3.87 0 0 0-6.586 3.092l-.02-.02a4.554 4.554 0 0 1-2.982 4.668 4.575 4.575 0 0 1-1.954.261l.019.02a3.825 3.825 0 0 0-3.082 1.097 3.812 3.812 0 0 0-1.1 3.076l-.02-.019a4.556 4.556 0 0 1-1.322 3.609 4.573 4.573 0 0 1-3.614 1.32l.019.019a3.872 3.872 0 0 0-3.863 2.201A3.857 3.857 0 0 0 2.1 25.82a3.87 3.87 0 0 0 4.38.764 3.865 3.865 0 0 0 2.206-3.856l.02.018a4.554 4.554 0 0 1 1.322-3.608 4.568 4.568 0 0 1 3.615-1.32Z" />
                        <path d="M6.594 15.71a3.834 3.834 0 0 0 1.1-3.076l.019.019a4.555 4.555 0 0 1 1.323-3.61 4.57 4.57 0 0 1 3.616-1.32l-.02-.018a3.872 3.872 0 0 0 3.86-2.202 3.856 3.856 0 0 0-.765-4.372 3.87 3.87 0 0 0-6.585 3.09l-.019-.019a4.554 4.554 0 0 1-1.322 3.61A4.569 4.569 0 0 1 4.187 9.13l.019.019A3.866 3.866 0 0 0 .8 10.64a3.85 3.85 0 0 0 2.229 6.113 3.868 3.868 0 0 0 3.567-1.044h-.002Zm120.587 5.006c-.708 0-1.32-.114-1.836-.342-.516-.228-.912-.552-1.188-.972-.276-.432-.414-.942-.414-1.53 0-.552.126-1.038.378-1.458.252-.432.636-.792 1.152-1.08.528-.288 1.182-.492 1.962-.612l3.006-.486v1.98l-2.52.45c-.384.072-.678.198-.882.378-.204.168-.306.414-.306.738 0 .3.114.534.342.702.228.168.51.252.846.252.444 0 .834-.096 1.17-.288a2 2 0 0 0 .774-.774c.192-.336.288-.702.288-1.098V14.02c0-.372-.15-.684-.45-.936-.288-.252-.684-.378-1.188-.378-.48 0-.906.132-1.278.396-.36.264-.624.612-.792 1.044l-2.16-1.026a3.51 3.51 0 0 1 .918-1.422 4.37 4.37 0 0 1 1.512-.918 5.545 5.545 0 0 1 1.926-.324c.828 0 1.56.15 2.196.45.636.3 1.128.72 1.476 1.26.36.528.54 1.146.54 1.854v6.48h-2.52v-1.584l.612-.108a4.954 4.954 0 0 1-.954 1.08 3.52 3.52 0 0 1-1.17.612 4.535 4.535 0 0 1-1.44.216Zm-9.581 0c-.984 0-1.872-.222-2.664-.666a5.23 5.23 0 0 1-1.872-1.854c-.456-.78-.684-1.656-.684-2.628 0-.972.228-1.842.684-2.61a4.912 4.912 0 0 1 1.872-1.836c.792-.444 1.68-.666 2.664-.666.732 0 1.41.126 2.034.378a4.619 4.619 0 0 1 1.602 1.062c.444.444.762.972.954 1.584l-2.34 1.008a2.303 2.303 0 0 0-.864-1.17 2.294 2.294 0 0 0-1.386-.432c-.468 0-.888.114-1.26.342-.36.228-.648.546-.864.954-.204.408-.306.876-.306 1.404 0 .528.102.996.306 1.404.216.408.504.726.864.954.372.228.792.342 1.26.342.54 0 1.008-.144 1.404-.432a2.34 2.34 0 0 0 .846-1.17l2.34 1.026a3.84 3.84 0 0 1-.936 1.548 4.836 4.836 0 0 1-1.602 1.08 5.43 5.43 0 0 1-2.052.378Zm-12.637 0c-.708 0-1.32-.114-1.836-.342-.516-.228-.912-.552-1.188-.972-.276-.432-.414-.942-.414-1.53 0-.552.126-1.038.378-1.458.252-.432.636-.792 1.152-1.08.528-.288 1.182-.492 1.962-.612l3.006-.486v1.98l-2.52.45c-.384.072-.678.198-.882.378-.204.168-.306.414-.306.738 0 .3.114.534.342.702.228.168.51.252.846.252.444 0 .834-.096 1.17-.288a2 2 0 0 0 .774-.774c.192-.336.288-.702.288-1.098V14.02c0-.372-.15-.684-.45-.936-.288-.252-.684-.378-1.188-.378-.48 0-.906.132-1.278.396-.36.264-.624.612-.792 1.044l-2.16-1.026a3.51 3.51 0 0 1 .918-1.422 4.37 4.37 0 0 1 1.512-.918 5.545 5.545 0 0 1 1.926-.324c.828 0 1.56.15 2.196.45.636.3 1.128.72 1.476 1.26.36.528.54 1.146.54 1.854v6.48h-2.52v-1.584l.612-.108a4.954 4.954 0 0 1-.954 1.08 3.52 3.52 0 0 1-1.17.612 4.535 4.535 0 0 1-1.44.216Zm-10.005 0c-.672 0-1.296-.12-1.872-.36a3.335 3.335 0 0 1-1.368-1.098l.252-.558v1.8h-2.52V6.874h2.7v5.67l-.414-.54c.324-.492.762-.87 1.314-1.134.564-.276 1.206-.414 1.926-.414.936 0 1.782.228 2.538.684a5.035 5.035 0 0 1 1.8 1.854c.444.768.666 1.632.666 2.592 0 .948-.222 1.812-.666 2.592a4.897 4.897 0 0 1-1.782 1.854c-.756.456-1.614.684-2.574.684Zm-.324-2.43c.504 0 .948-.114 1.332-.342a2.38 2.38 0 0 0 .9-.954c.216-.408.324-.876.324-1.404 0-.528-.108-.99-.324-1.386a2.38 2.38 0 0 0-.9-.954 2.46 2.46 0 0 0-1.332-.36c-.48 0-.912.114-1.296.342a2.42 2.42 0 0 0-.882.954c-.204.408-.306.876-.306 1.404 0 .528.102.996.306 1.404.216.408.51.726.882.954a2.49 2.49 0 0 0 1.296.342ZM82.243 24.46a5.76 5.76 0 0 1-2.106-.378 4.925 4.925 0 0 1-1.674-1.062 3.899 3.899 0 0 1-.99-1.584l2.502-.882c.132.456.401.816.81 1.08.407.264.894.396 1.458.396.444 0 .828-.084 1.151-.252.325-.156.57-.39.738-.702.18-.312.27-.678.27-1.098v-2.25l.522.648a3.295 3.295 0 0 1-1.296 1.242c-.528.264-1.145.396-1.853.396-.913 0-1.729-.204-2.449-.612a4.538 4.538 0 0 1-1.691-1.71c-.409-.732-.613-1.56-.613-2.484 0-.924.204-1.74.612-2.448a4.445 4.445 0 0 1 1.674-1.692c.708-.408 1.512-.612 2.412-.612.709 0 1.326.144 1.855.432.528.276.977.702 1.35 1.278l-.343.648v-2.142h2.52v9.306c0 .864-.21 1.632-.63 2.304a4.364 4.364 0 0 1-1.727 1.602c-.72.384-1.555.576-2.502.576Zm-.09-6.894c.456 0 .851-.096 1.188-.288.336-.192.594-.462.774-.81.192-.348.288-.756.288-1.224 0-.468-.097-.876-.288-1.224a2.028 2.028 0 0 0-.792-.828 2.21 2.21 0 0 0-1.17-.306 2.44 2.44 0 0 0-1.225.306 2.113 2.113 0 0 0-.828.828c-.191.348-.287.756-.287 1.224 0 .456.096.858.287 1.206.205.348.48.624.829.828.36.192.767.288 1.224.288ZM66.283 20.5v-9.828h2.52v1.944l-.144-.432c.228-.588.594-1.02 1.098-1.296.516-.288 1.116-.432 1.8-.432.744 0 1.392.156 1.944.468.564.312 1.002.75 1.314 1.314.312.552.468 1.2.468 1.944V20.5h-2.7v-5.742c0-.384-.078-.714-.234-.99a1.56 1.56 0 0 0-.63-.648 1.806 1.806 0 0 0-.936-.234c-.348 0-.66.078-.936.234a1.681 1.681 0 0 0-.648.648c-.144.276-.216.606-.216.99V20.5h-2.7Zm-7.812.216c-.708 0-1.32-.114-1.836-.342-.516-.228-.912-.552-1.188-.972-.276-.432-.414-.942-.414-1.53 0-.552.126-1.038.378-1.458.252-.432.636-.792 1.152-1.08.528-.288 1.182-.492 1.962-.612l3.006-.486v1.98l-2.52.45c-.384.072-.678.198-.882.378-.204.168-.306.414-.306.738 0 .3.114.534.342.702.228.168.51.252.846.252.444 0 .834-.096 1.17-.288a2 2 0 0 0 .774-.774c.192-.336.288-.702.288-1.098V14.02c0-.372-.15-.684-.45-.936-.288-.252-.684-.378-1.188-.378-.48 0-.906.132-1.278.396-.36.264-.624.612-.792 1.044l-2.16-1.026a3.51 3.51 0 0 1 .918-1.422 4.37 4.37 0 0 1 1.512-.918 5.545 5.545 0 0 1 1.926-.324c.828 0 1.56.15 2.196.45.636.3 1.128.72 1.476 1.26.36.528.54 1.146.54 1.854v6.48h-2.52v-1.584l.612-.108a4.954 4.954 0 0 1-.954 1.08 3.52 3.52 0 0 1-1.17.612 4.535 4.535 0 0 1-1.44.216Zm-10.649 0c-.792 0-1.47-.168-2.034-.504a3.346 3.346 0 0 1-1.26-1.44c-.288-.612-.432-1.326-.432-2.142v-5.958h2.7v5.742c0 .372.072.702.216.99.156.276.372.492.648.648.276.156.588.234.936.234.36 0 .672-.078.936-.234a1.56 1.56 0 0 0 .63-.648c.156-.288.234-.618.234-.99v-5.742h2.7V20.5h-2.52v-1.944l.144.432c-.228.588-.6 1.026-1.116 1.314-.504.276-1.098.414-1.782.414ZM36.99 20.5v-9.828h2.52v2.358l-.18-.341c.216-.829.57-1.386 1.062-1.675.504-.3 1.098-.45 1.782-.45h.576v2.34h-.846c-.66 0-1.194.204-1.602.613-.408.396-.612.96-.612 1.692V20.5h-2.7Z" />
                    </svg>
                </a>
                <!-- End: Logo -->
                <div class="d-flex flex-column heading-page">
                    <h1 class="heading-table-page">Dashboard</h1>
                    <p class="subtitle-table-page">Dashboard</p>
                </div>
            </div>

            <div class="navbar-content">
                <!-- <a href="">
              <svg class="navbar-borrowing-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.333 3.892V13.95c0 .8-.65 1.55-1.45 1.65l-.275.033c-1.816.242-4.616 1.167-6.216 2.05-.217.125-.575.125-.8 0l-.034-.016c-1.6-.875-4.391-1.792-6.2-2.034l-.241-.033c-.8-.1-1.45-.85-1.45-1.65V3.883a1.64 1.64 0 0 1 1.8-1.658c1.75.142 4.4 1.025 5.883 1.95l.208.125c.242.15.642.15.884 0l.141-.092a12.85 12.85 0 0 1 1.917-.941v3.4l1.667-1.109 1.666 1.109v-4.35c.225-.042.442-.067.642-.084h.05a1.642 1.642 0 0 1 1.808 1.659ZM10 4.575v12.5"/>
                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.833 2.317v4.35l-1.666-1.109L12.5 6.667v-3.4c1.092-.434 2.308-.784 3.333-.95Z"/>
              </svg>
            </a>

            <div class="vertical-divider"></div> -->

                <div class="account-profile d-flex">
                    <img class="photo-profile" src="bunga2.jpeg" alt="" height="40px" width="40px">
                    <div class="navbar-content-text d-flex">
                        <p class="navbar-content-name fw-bold lh-1 text-nowrap">Muhammad Naufal Kurniawan</p>
                        <p class="navbar-content-users">Staf</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- End: NAVBAR -->

    </div>
    <!-- End: Fixed Layer -->



    <!-- Start: Main Layer -->
    <main class="container-main d-flex flex-column dashboard">

        <?php
            // include 'modules/staff/staff_views/dashboard.php';
        ?>

    </main>
    <!-- End: Main Layer -->
</body>

</html>