<?php

trait AcceptableTrait {

    /**
     * Accept user
     */
    public function accept()
    {
        $this->active = true;
        $this->save();
    }

    /**
     * Refuse user
     */
    public function refuse()
    {
        $this->active = false;
        $this->save();
    }
}