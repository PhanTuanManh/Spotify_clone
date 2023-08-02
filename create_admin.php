require_once 'vendor/autoload.php'; // Đảm bảo tải các tệp Composer autoloader nếu cần thiết

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Tạo một bản ghi mới cho tài khoản admin
$user = new User();

// Điền thông tin cho tài khoản admin
$user->name = 'Admin';
$user->email = 'admin@examplee.com';
$user->password = Hash::make('password'); // Thay 'password' bằng mật khẩu mong muốn cho tài khoản admin

// Lưu bản ghi vào cơ sở dữ liệu
$user->save();

echo "Tài khoản admin đã được tạo thành công!\n";
