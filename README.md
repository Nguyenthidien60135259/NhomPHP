# NhomPHP
I. Hướng dẫn chạy và dùng Web tin tức

1.	Cài đặt
-	Cài đặt laravel & composer :https://www.youtube.com/watch?v=-SwzQ7-ipW8&t=315s
-	Download Project về máy
-	Kiểm tra project đã có file .env chưa. Nếu chưa thì tiến hành cài đặt theo các bước :
cp .env.example .env
php artisan key:generate
php artisan cache:clear
php artisan config:clear
Đổi tên database ở dòng 13 DB_DATABASE='tên database trên phpAdmin mà bạn đặt'
- Trường hợp chưa có file vendor cài đặt theo các bước:
composer dump-autoload
composer update
- Sau khi cài đặt hoàn tất thì chạy thử chương trình theo cú pháp: php artisan serve 

2.	Truy cập trang tin tức
	Admin
-	Truy cập: http://127.0.0.1:8000/admin/dangnhap
-	Đăng nhập vào Admin:
+ Tài khoản: admin@gmail.com
+ Mật khẩu: 123456
-	Sau khi đăng nhập thàng công sẽ hiện ra giao diện bạn có thể tùy chọn các đối tượng (thể loại, tin tức, side, loại tin, user) để thêm, xóa, sửa, tìm kiếm
- Admin có chức năng phân quyền người dùng (nếu tạo thêm user thì có thể phân quyền admin hoặc người dùng).

	Users
-	Truy cập: http://127.0.0.1:8000/trangchu
-	Người dùng có thể xem, tìm kiếm tin tức, liên hệ, giới thiệu (không cần tài khoản). Đối với chức năng bình luận người dùng cần đăng nhập tài khoản.
-	Khi đăng ký Users: http://127.0.0.1:8000/dangky
+ Name: Tên người dùng phải từ 6 kí tự (chữ hoặc số)
+ Email: Phải đúng định dạng vd abc@gmail.com
+ Password: Ít nhất 6 kí tự và không vượt quá 32 kí tự.
- Sau khi đăng ký tài khoản thành công thì bạn đăng nhập và vào trang web để có thể thực hiện chức năng bình luận.
CHÚC CÁC BẠN THÀNH CÔNG <3

II. Phân công công việc
1.Admin
  -Nguyễn Thị Thanh Tuyền
    + Tin tức, thể loại, thiết kế SQL
  -Hồ Nguyễn Hồng Huệ
    + Loại tin User
    + Quản lý người dùng, slide, loại tin
2.Người dùng
  -Nguyễn Thị Diễn
    + Đăng kí, đăng nhập
    + Liên hệ, giới thiệu
  -Nguyễn Hoàng Việt
    + Thiết kế SQL
    + Tìm kiếm, Phân trang, comment
    + Chi tiết tin tức
    + Trang chủ
  
