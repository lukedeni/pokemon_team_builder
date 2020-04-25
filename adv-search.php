<?php
    require "header.php";
?>

<main>
      <div class="wrapper-main">
        <section class="section-default">
                <h2> Advanced Search </h2>
                        <p> Use this page to hone your search beyond basic keyword matching on from the navbar search functionality. You can look for specific attributes of teams or pokemon. </p> 
                
                <!-- start form -->
                <form action="search.php" method="post" >
                <p>
                <div class="input-group mb-4">
                    <input style="display: inline !important;" type="text" name="search_query" class="form-control" id="inlineFormInputGroup" placeholder="Search...">
                    <button class="btn btn-primary my-2 my-sm-0" style="margin-left: 5px;" name="search-submit" type="submit">Search</button>
                </div>
                <button class="btn btn-primary-outline" type="button" data-toggle="collapse" href="#collapsePoke" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Sort on Pokemon
                </button>
                <button class="btn btn-primary-outline" type="button" data-toggle="collapse" data-target="#collapseTeams" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Sort on Teams
                </button>
                </p>
                <div class="collapse" id="collapsePoke">
                    <div class="border rounded card-body form-group" style="font-size: 16px !important; font-weight: normal !important;">
                        <div class="form-group" style="font-size: 16px !important; margin-top: 0px; margin-bottom: 15px;">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="more-hp" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">More than</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="less-hp" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Less than</label>
                            </div>
                            <input style="margin-top: 5px;" class="form-control form-control-sm" type="text" placeholder="# HP">
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" value="normal">
                            <label class="form-check-label" for="inlineCheckbox1">normal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox2" value="fighting">
                            <label class="form-check-label" for="inlineCheckbox2">fighting</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox3" value="flying">
                            <label class="form-check-label" for="inlineCheckbox3">flying</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox4" value="poison">
                            <label class="form-check-label" for="inlineCheckbox1">poison</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox5" value="ground">
                            <label class="form-check-label" for="inlineCheckbox2">ground</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox6" value="rock">
                            <label class="form-check-label" for="inlineCheckbox3">rock</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox7" value="bug">
                            <label class="form-check-label" for="inlineCheckbox1">bug</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox8" value="ghost">
                            <label class="form-check-label" for="inlineCheckbox2">ghost</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox9" value="steel">
                            <label class="form-check-label" for="inlineCheckbox3">steel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox10" value="fire">
                            <label class="form-check-label" for="inlineCheckbox1">fire</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox11" value="water">
                            <label class="form-check-label" for="inlineCheckbox2">water</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox12" value="grass">
                            <label class="form-check-label" for="inlineCheckbox3">grass)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox13" value="electric">
                            <label class="form-check-label" for="inlineCheckbox1">electric</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox14" value="psychic">
                            <label class="form-check-label" for="inlineCheckbox2">psychic</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox15" value="ice" >
                            <label class="form-check-label" for="inlineCheckbox3">ice</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox16" value="dragon">
                            <label class="form-check-label" for="inlineCheckbox1">dragon</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox17" value="dark">
                            <label class="form-check-label" for="inlineCheckbox2">dark</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox18" value="fairy">
                            <label class="form-check-label" for="inlineCheckbox3">fairy</label>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseTeams">
                    <div class="card card-body">
                        <div class="form-group" style="font-size: 16px !important; font-weight: normal !important; margin-top: 0px; margin-bottom: 15px;">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="more-battles" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">More than</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="less-battles" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Less than</label>
                            </div>
                            <input style="margin-top: 5px;" class="form-control form-control-sm" type="text" placeholder="# total battles">
                        </div>

                        <select class="form-control form-control-sm">
                            <option value="wl-na" selected="selected">No. wins vs. losses are unimportant</option>
                            <option value="wl-more" >More wins than losses</option>
                            <option value="wl-less">More losses than wins</option>
                        </select>
                    </div>
                </div>
            </form>
            <!-- end form -->
        </section>
      </div>
    </main>