<?php

namespace CrmPackage\Enums;

enum CallResult: string
{
    case NO_ANSWER = 'no_answer';
    case CALLBACK_LATER = 'callback_later';
    case SUCCESS = 'success';
}
