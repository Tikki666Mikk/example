<?php

require_once('database.class..php');

class Specializations extends Database
{

    public function echoSpecializations()
    {
        foreach ($this->getDB()->query('SELECT * FROM specializations') as $info) {
            $helps = $info['helps'];
            $helps = explode(', ', $helps. 0);

           echo '<div class="item">
            <div class="row">
                <div class=" col-lg-9 col-md-8 col-xs-12">
                    <div class="h3">
                        ' . $info['head'] . '
                    </div>
                </div>

                <div class=" col-lg-3 col-xs-4 hidden-sm-down">
                    <a href="registration.php" class="reg-link">
                        Принять участие
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-8 col-xs-12">
                    <div class="text">
                        ' . $info['text'] . '
                    </div>
                </div>

                <div class="col-xl-6 col-md-4 col-xs-12">
                    <div class="lists">
                        Чем вы можете помочь:

                        <ul>
                            <li>' .$helps[0] . '</li>
                            <li>' .$helps[1] . '</li>
                            <li>' .$helps[2] . '</li>
                            <li>' .$helps[3] . '</li>
                        </ul>
                    </div>
                </div>

                <a href="#" class="reg-link hidden-md-up">
                    Принять участие
                </a>
            </div>
        </div>';
        }
    }

    public function echoSpecializationsName()
    {
        foreach ($this->getDB()->query('SELECT * FROM specializations') as $info) {

            echo '<option value="' . $info['head'] . '">' . $info['head'] . '</option>';
        }
    }
}