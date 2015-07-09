<?php namespace Tests;
use \XREmitter\Events\ModuleViewed as Event;

class DiscussionViewedTest extends EventTest {
    protected static $recipe_name = 'discussion_viewed';

    /**
     * Sets up the tests.
     * @override EventTest
     */
    public function setup() {
        $this->event = new Event($this->repo);
    }

    protected function constructInput() {
        return array_merge(
            parent::constructInput(),
            $this->contructObject('course'),
            $this->contructObject('module'),
            $this->constructDiscussion()
        );
    }

    protected function assertOutput($input, $output) {
        parent::assertOutput($input, $output);
        $this->assertVerb('http://adlnet.gov/expapi/activities/interaction', 'viewed', $output['verb']);
        $this->assertObject('module', $input, $output['object']);
        $this->assertObject('course', $input, $output['context']['contextActivities']['grouping'][0]);
        $this->assertDiscussion($input, $output['object']);
    }
}