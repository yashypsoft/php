<?php

$handle = fopen('names.txt','r');
echo fread($handle,5000);