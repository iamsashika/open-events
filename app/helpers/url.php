<?php

function url($path = '')
{
    return rtrim(URLROOT, '/') . '/' . ltrim($path, '/');
}