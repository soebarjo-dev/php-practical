<?php

class General
{
    public function redirectTo(string $path): void {
        header("Location: $path");
        exit();
    }
}