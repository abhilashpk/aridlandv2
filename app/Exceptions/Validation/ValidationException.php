<?php
declare(strict_types=1);

namespace App\Exceptions\Validation;

use Exception;
use Throwable;

class ValidationException extends Exception
{
	protected $errors;

	public function __construct(string $message = 'Validation error', $errors = null, int $code = 0, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->errors = $errors;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}
