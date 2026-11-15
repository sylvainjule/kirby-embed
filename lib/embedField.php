<?php

namespace SylvainJule;

use Kirby\Data\Yaml;
use Kirby\Form\Field\UrlField;
use Kirby\Reflection\Attributes\Prop;
use Throwable;

class EmbedField extends UrlField {
    #[Prop]
    protected string|null $provider = null;

    #[Prop]
    protected bool $icons = false;

    public function fill(mixed $value): static {
        if(is_array($value) === true) {
            $value = Yaml::encode($value);
        }

        $this->value = is_string($value) ? $value : '';
        return $this;
    }

    public function toFormValue(): array|string {
        if($this->value === '') {
            return '';
        }

        try {
            $data = Yaml::decode($this->value);

            if($data !== [] && array_is_list($data) === false) {
                return $data;
            }
        } 
        catch (Throwable $error) {}

        return $this->value;
    }

    public function toStoredValue(): string {
        return $this->value;
    }

    protected function validations(): array {
        return [];
    }
}