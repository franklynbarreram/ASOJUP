import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Bar from './Bar';

const example_div = document.getElementById('example_div');

const props = Object.assign({}, example_div.dataset)

ReactDOM.render(<Bar {...props}/>, example_div);
