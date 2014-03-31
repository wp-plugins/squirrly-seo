<?php

class Model_SQ_PostsList {

    /** @var integer */
    public $post_id;
    public $audit;

    /**
     * Get the traffic total
     * @return array
     */
    public function getTotal($response) {
        if (isset($response->posts)) {
            $ranking = SQ_ObjController::getController('SQ_Ranking', false);

            foreach ($response->posts as $post_id => &$values) {
                if (isset($values->error)) {
                    if ($values->error == 'post_limited' && isset($values->error_message)) {
                        $values = '<span class="sq_no_rank" ref="' . $post_id . '"><a href="' . $values->error_link . '" target="_blank">' . $values->error_message . '</a></span>';
                        continue;
                    }
                }

                $graph = ''; //reset the graph
                if (isset($values->visits)) {

                    if (!empty($values->visits)) {
                        $data = array();
                        $data[] = array('', __('Visits', _SQ_PLUGIN_NAME_));
                        foreach ($values->visits as $key => $visit) {
                            $data[] = array($key, (int) number_format_i18n($visit));
                        }
                        $graph = '<div class="sq_chart_title">' . __('monthly traffic', _SQ_PLUGIN_NAME_) . '</div><div id="sq_chart_' . $post_id . '" style="margin:0 auto; width:100px; height:40px;"></div><script>jQuery( document ).ready(function() {drawChart("sq_chart_' . $post_id . '", ' . json_encode($data) . ',false);});</script>';
                    }

                    $values = $graph . '<span class="sq_rank_column_button sq_show_more" ref="' . $post_id . '">' . __('See Analytics', _SQ_PLUGIN_NAME_) . '</span>';
                } else {
                    $values = '<span class="sq_optimize" ref="' . $post_id . '">' . __('Optimize it with Squirrly to see the Analytics', _SQ_PLUGIN_NAME_) . '</span>';
                }
            }
        }
        return $response;
    }

    public function getAnalytics($analytics) {
        $this->audit = $analytics;
        if (isset($this->audit->content)) {
            foreach ($this->audit->content as $key => $audit) {
                $group[$key]['name'] = $key;
                if (!empty($audit)) {
                    $group[$key]['total'] = 0;
                    $group[$key]['complete'] = 0;
                    $group[$key]['processed'] = 0;

                    foreach ($audit as $task) {
                        @$group[$key]['total'] = number_format_i18n($task->total);
                        @$group[$key]['complete'] += ($task->complete) ? 1 : 0;
                        @$group[$key]['processed'] += 1;
                    }

                    $color = 'sq_audit_task_completed_green';

                    if ($group[$key]['complete'] < ($group[$key]['processed'] / 2)) {
                        $color = 'sq_audit_task_completed_red';
                    }
                    if ($group[$key]['complete'] >= ($group[$key]['processed'] / 2)) {
                        $color = 'sq_audit_task_completed_yellow';
                    }

                    //custom values
                    if ($key == 'rank' && $group[$key]['total'] <= 10) { //in case of first page
                        $color = 'sq_audit_task_completed_green';
                    }
                    if ($key == 'links' && $group[$key]['total'] > 50) { //in case of first page
                        $color = 'sq_audit_task_completed_yellow';
                    }
                    if ($key == 'authority' && $group[$key]['total'] > 70) { //in case of first page
                        $color = 'sq_audit_task_completed_yellow';
                    }

                    if ($group[$key]['complete'] == $group[$key]['processed']) {
                        $color = 'sq_audit_task_completed_green';
                    }
                    //if the post its just indexed with the url then is not so good
                    if ($key == 'rank' && (int) $group[$key]['total'] == 0) {
                        $color = 'sq_audit_task_completed_yellow';
                    }

                    @$group[$key]['color'] = $color;
                }
            }
            $this->audit->groups = json_decode(json_encode($group));

            return $this->audit;
        } else {
            return false;
        }
    }

}
