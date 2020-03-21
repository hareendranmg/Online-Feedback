<?php
        $conn = mysqli_connect("localhost", "root", "keltron@123", "online_feedback");

        if (mysqli_connect_errno()) {
            echo "Failed to connect: " . mysqli_connect_errno();
        }
