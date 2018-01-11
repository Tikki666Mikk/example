<?php

require_once('database.class..php');

class Events extends Database
{

    public function echoEvents()
    {
        foreach ($this->getDB()->query('SELECT * FROM events') as $info) {
            $date = date('Y.m.d', strtotime($info['date']));

            echo '<div class="swiper-slide">
                            <div class="item clearfix">
                                <div class="img">
                                    <img src="images/' . $info['image'] . '" alt="#">
                                </div>

                                <div class="right-side">
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
                            </div>
                        </div>';
        }
    }
}