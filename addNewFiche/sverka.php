<?php

$url = "genius:location=674380<<<*>>>������<<<*>>>������������� ����<<<*>>>�����<<<*>>>�� ���������� �. 1 ��. 1<<<*>>>&name=����� ������ ��������&phone=89131977970&email=manager3@tescoma-shop.ru&comment=&delivery=����� ������&pay=������ ��� ���������&id=40223&itemArt_1=308846&itemPrice_1=2529&itemColich_1=3&itemArt_2=630676&itemPrice_2=801&itemColich_2=1&itemArt_3=880528&itemPrice_3=632&itemColich_3=1&itemArt_4=662062&itemPrice_4=366&itemColich_4=1";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "192.168.100.71:5000");
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data", "Expect:"));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
$result = curl_exec($ch);
curl_close($ch);