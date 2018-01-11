<?php

require_once('database.class..php');

class News extends Database
{

    public function echoNews()
    {
        foreach ($this->getDB()->query('SELECT * FROM news') as $info) {
            $date = date('Y.m.d', strtotime($info['date']));

            echo '<div class="swiper-slide">
                    <div class="item">
                        <div class="img">
                            <img src="images/' . $info['image'] . '" alt="#">
                        </div>
                        <div class="text">
                           ' . $info['text'] . '
                        </div>
                        <div class="bottom-line clearfix">
                            <div class="date">
                               ' . $date . '
                            </div>
                            <a href="#" class="detail">
                                Подробнее
                            </a>
                        </div>
                    </div>
                  </div>';
        }
    }
}