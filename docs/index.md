# Php Queue system
Master:
[![Build Status](https://travis-ci.org/gianarb/lean-queue.svg?branch=master)](https://travis-ci.org/gianarb/lean-queue)
Develop:
[![Build Status](https://travis-ci.org/gianarb/lean-queue.svg?branch=develop)](https://travis-ci.org/gianarb/lean-queue)

[LeanQueue](https://github.com/gianarb/lean-queue) is an easy queue system written in PHP.  
It supports different adapters, in this moment:  

* ArrayAdapter for test environment
* AwsAdapter to manage queue with [SNS](http://aws.amazon.com/sns/)

## Install
```bash
php composer.phar require "gianarb\lean-queue"
```
