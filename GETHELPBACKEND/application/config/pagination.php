<?php

//config
$config['base_url'] = 'http://localhost/GETHELPBACKEND/campaign';

//styling pagination
$config['full_tag_open'] = '<nav><ul class="pagination mb-0">';
$config['full_tag_close'] = ' </ul></nav>';

$config['first_link'] = 'first';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'last';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '&raquo;';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&laquo;';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

//current page
$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

$config['attributes'] = array('class' => 'page-link');

$config['num_links'] = 3;
