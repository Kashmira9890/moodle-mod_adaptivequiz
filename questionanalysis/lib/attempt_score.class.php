<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Attempt-score class
 *
 * This class provides access to various numeric representations of a score.
 *
 * This module was created as a collaborative effort between Middlebury College
 * and Remote Learner.
 *
 * @package    mod_adaptivequiz
 * @copyright  2013 Middlebury College {@link http://www.middlebury.edu/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class adaptivequiz_attempt_score {
    
    /** @var float $measured_ability_logits The measured ability of the attempt in logits. */
    protected $measured_ability_logits = null;
    
    /** @var float $standard_error_logits The standard error in the score in logits. */
    protected $standard_error_logits = null;
    
    /** @var float $lowest_level The lowest level of question in the adaptive quiz. */
    protected $lowest_level = null;
    
    /** @var float $highest_level The highest level of question in the adaptive quiz. */
    protected $highest_level = null;
    
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct ($measured_ability_logits, $standard_error_logits, $lowest_level, $highest_level) {
        $this->measured_ability_logits = $measured_ability_logits;
        $this->standard_error_logits = $standard_error_logits;
        $this->lowest_level = $lowest_level;
        $this->highest_level = $highest_level;
    }
    
    /**
     * Answer the measured ability in logits.
     * 
     * @return float
     */
    public function measured_ability_in_logits () {
    	return $this->measured_ability_logits;
    }
    
    /**
     * Answer the standard error in logits.
     * 
     * @return float
     */
    public function standard_error_in_logits () {
    	return $this->standard_error_logits;
    }
    
    /**
     * Answer the measured ability as a fraction 0-1.
     * 
     * @return float
     */
    public function measured_ability_in_fraction () {
    	return catalgo::convert_logit_to_fraction($this->measured_ability_logits);
    }
    
    /**
     * Answer the standard error a fraction 0-0.5.
     * 
     * @return float
     */
    public function standard_error_in_fraction () {
    	return catalgo::convert_logit_to_percent($this->standard_error_logits);
    }
    
    /**
     * Answer the measured ability on the adaptive quiz's scale
     * 
     * @return float
     */
    public function measured_ability_in_scale () {
    	return catalgo::map_logit_to_scale($this->measured_ability_logits, $this->highest_level, $this->lowest_level);
    }
    
    /**
     * Answer the standard error on the adaptive quiz's scale
     * 
     * @return float
     */
    public function standard_error_in_scale () {
    	return catalgo::convert_logit_to_percent($this->standard_error_logits) * ($this->highest_level - $this->lowest_level);
    }
}
