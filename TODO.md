# TODO: Correct Errors in Code

## 1. Fix Migration Inconsistencies
- Update `CreateEnrollmentsTable.php`: Add 'unsigned' => true and 'constraint' => 9 to 'id', 'user_id', 'course_id' fields for consistency.
- Update `CreateMaterialsTable.php`: Add 'unsigned' => true and 'constraint' => 9 to 'id', 'course_id' fields. Add 'uploaded_by' field.
- Update `UpdateMaterialsTable.php`: Change to add 'uploaded_by' field instead of 'course_id' and 'file_path'.

## 2. Fix EnrollmentModel.php
- Change `enrollUser` method to accept an array parameter instead of two separate parameters.

## 3. Fix MaterialModel.php
- Update `allowedFields` to include 'uploaded_by' and match field names: ['course_id', 'filename', 'filepath', 'uploaded_by', 'uploaded_at'].

## 4. Fix Course.php Controller
- No changes needed, as enrollUser now accepts array.

## 5. Fix Student.php Controller
- Change `array_column($data['enrolledCourses'], 'course_id')` to `array_column($data['enrolledCourses'], 'id')`.

## 6. Fix Material.php Controller
- Update insert to use correct field names: 'filename', 'filepath', 'uploaded_by', 'uploaded_at'.
- Update select in index to alias 'users.username as uploader_name'.
- Ensure download uses 'filepath'.

## 7. Test and Verify
- Run migrations to apply changes.
- Test enrollment, material upload/download.
