<?php
        $conn = mysqli_connect("localhost", "root", "", "online_feedback");

        if (mysqli_connect_errno()) {
            echo "Failed to connect: " . mysqli_connect_errno();
        }
