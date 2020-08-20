# 5.0.0

## Changes

- Renamed namespace `Core23\Form` to `Nucleos\Form` after move to [@nucleos]

  Run

  ```
  $ composer remove core23/form-extensions
  ```

  and

  ```
  $ composer require nucleos/form-extensions
  ```

  to update.

  Run

  ```
  $ find . -type f -exec sed -i '.bak' 's/Core23\\Form/Nucleos\\Form/g' {} \;
  ```

  to replace occurrences of `Core23\Form` with `Nucleos\Form`.

  Run

  ```
  $ find -type f -name '*.bak' -delete
  ```

  to delete backup files created in the previous step.
  
## 🚀 Features

- Add combined assets @core23 (#68)

## 📦 Dependencies

- Drop support for PHP 7.2 @core23 (#59)


# 4.0.2

## Changes

## 🐛 Bug Fixes

- Fix wrong date after validation for null values @core23 (#55)

# 4.0.1

## Changes

## 🐛 Bug Fixes

- Remove date after violation if not required @core23 (#54)

# 4.0.0

## Changes

- Use class alias in validators @core23 (#50)
- Add missing strict file header @core23 (#44)
- Add missing (optional) doctrine extension @core23 (#39)
- Use dataset instead of getAttribute @core23 (#34)

## ❌ BC Breaks

- Remove custom Date(Time)PickerType @core23 (#40)

## 🚀 Features

- Add support for symfony 5 @core23 (#32)

## 📦 Dependencies

- Add missing twig bridge dependency @core23 (#31)