# 🌸 BloomGift – Website Hoa Tươi & Quà Tặng

> **Đồ án cơ sở Công nghệ thông tin – Xây dựng website hoa tươi và quà tặng theo dịp lễ.**

BloomGift là hệ thống website hỗ trợ khách hàng **tìm kiếm, lựa chọn, đặt mua hoa tươi và quà tặng trực tuyến**, lựa chọn thông tin giao hàng, thanh toán và theo dõi trạng thái đơn hàng.

Hệ thống được xây dựng bằng **Laravel theo mô hình MVC**, sử dụng **MySQL** để quản lý dữ liệu và tích hợp **PayPal Sandbox** để mô phỏng thanh toán trực tuyến.

---

## 📌 Thông tin đồ án

| Nội dung | Thông tin |
|---|---|
| Tên đề tài | BloomGift – Website hoa tươi và quà tặng |
| Loại đồ án | Đồ án cơ sở Công nghệ thông tin |
| Số thành viên | 03 |
| Thời gian thực hiện | 26/08/2026 – 30/10/2026 |
| Kiến trúc | Laravel MVC |
| Cơ sở dữ liệu | MySQL |
| Thanh toán thử nghiệm | COD / PayPal Sandbox |

---

## 📚 Mục lục

- [Giới thiệu](#-giới-thiệu)
- [Mục tiêu](#-mục-tiêu)
- [Đối tượng sử dụng](#-đối-tượng-sử-dụng)
- [Chức năng hệ thống](#-chức-năng-hệ-thống)
- [Quy trình đặt hàng](#-quy-trình-đặt-hàng)
- [Đặt hoa theo yêu cầu](#-đặt-hoa-theo-yêu-cầu)
- [Trạng thái đơn hàng](#-trạng-thái-đơn-hàng)
- [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
- [Kiến trúc hệ thống](#-kiến-trúc-hệ-thống)
- [Cơ sở dữ liệu](#-cơ-sở-dữ-liệu)
- [Cài đặt](#-cài-đặt)
- [Cấu hình PayPal Sandbox](#-cấu-hình-paypal-sandbox)
- [Bảo mật và phân quyền](#-bảo-mật-và-phân-quyền)
- [Phân công thành viên](#-phân-công-thành-viên)
- [Kế hoạch thực hiện 10 tuần](#-kế-hoạch-thực-hiện-10-tuần)
- [Nguyên tắc làm việc với Git](#-nguyên-tắc-làm-việc-với-git)

---

## 🌷 Giới thiệu

BloomGift được xây dựng nhằm tạo ra một hệ thống mua sắm hoa và quà tặng trực tuyến có quy trình rõ ràng từ:

```text
Xem sản phẩm
      ↓
Thêm vào giỏ
      ↓
Giỏ hàng
      ↓
Checkout
      ↓
Thanh toán
      ↓
Đơn hàng
      ↓
Theo dõi trạng thái đơn hàng
```

Bên cạnh quy trình đặt hàng thông thường, hệ thống còn hỗ trợ **Đặt hoa theo yêu cầu**, cho phép khách hàng gửi yêu cầu riêng và Admin tiếp nhận, xử lý hoặc **Xác nhận & tạo đơn**.

Đồ án tập trung vào các nội dung của một hệ thống thông tin hoàn chỉnh gồm:

- Phân tích nghiệp vụ.
- Thiết kế hệ thống.
- Thiết kế cơ sở dữ liệu.
- Xây dựng giao diện.
- Lập trình chức năng.
- Tích hợp hệ thống.
- Quản lý mã nguồn.
- Kiểm thử và hoàn thiện sản phẩm.

---

## 🎯 Mục tiêu

### Mục tiêu tổng quát

Xây dựng website BloomGift phục vụ hoạt động mua bán hoa tươi và quà tặng trực tuyến, có khu vực **Customer** và **Admin**, hỗ trợ quy trình đặt hàng, thanh toán và quản lý đơn hàng.

### Mục tiêu cụ thể

- Xây dựng chức năng **Đăng ký**.
- Xây dựng chức năng **Đăng nhập**.
- Xây dựng chức năng **Đăng xuất**.
- Xây dựng chức năng **Hồ sơ**.
- Xây dựng **Trang chủ**.
- Xây dựng **Danh mục**.
- Xây dựng **Sản phẩm**.
- Xây dựng **Xem chi tiết**.
- Xây dựng **Tìm kiếm**.
- Xây dựng **Yêu thích**.
- Xây dựng **Thêm vào giỏ**.
- Xây dựng **Đặt hàng**.
- Xây dựng **Giỏ hàng**.
- Xây dựng **Checkout**.
- Hỗ trợ **Chọn ngày giao hàng**.
- Hỗ trợ **Chọn khung giờ giao hàng**.
- Hỗ trợ **Thiệp/lời chúc**.
- Hỗ trợ **Gói quà**.
- Hỗ trợ **Thanh toán COD**.
- Tích hợp **PayPal Sandbox**.
- Xây dựng **Đơn hàng**.
- Xây dựng **Theo dõi trạng thái đơn hàng**.
- Xây dựng **Đặt hoa theo yêu cầu**.
- Xây dựng **Yêu cầu của tôi**.
- Xây dựng **Admin Dashboard**.
- Xây dựng **Quản lý sản phẩm**.
- Xây dựng **Quản lý đơn hàng**.
- Hỗ trợ **Xem danh sách đơn hàng**.
- Hỗ trợ **Xem chi tiết đơn hàng**.
- Hỗ trợ **Cập nhật trạng thái đơn hàng**.
- Xây dựng **Thông báo yêu cầu đặt hoa**.
- Hỗ trợ **Nhận yêu cầu**.
- Hỗ trợ **Từ chối**.
- Hỗ trợ **Xác nhận & tạo đơn**.

---

## 👥 Đối tượng sử dụng

### Guest

Guest là người dùng chưa đăng nhập.

Guest có thể:

- Xem các nội dung công khai của hệ thống.
- Xem sản phẩm.
- Tìm kiếm sản phẩm.
- Xem chi tiết sản phẩm.
- Đăng ký.
- Đăng nhập.
- Gửi **Đặt hoa theo yêu cầu**.

### Customer

Customer là khách hàng đã đăng nhập.

Customer có thể:

- Sử dụng **Hồ sơ**.
- Xem **Trang chủ**.
- Xem **Danh mục**.
- Xem **Sản phẩm**.
- **Xem chi tiết**.
- **Tìm kiếm**.
- Sử dụng **Yêu thích**.
- **Thêm vào giỏ**.
- Sử dụng **Giỏ hàng**.
- Thực hiện **Checkout**.
- **Chọn ngày giao hàng**.
- **Chọn khung giờ giao hàng**.
- Thêm **Thiệp/lời chúc**.
- Chọn **Gói quà**.
- Chọn **Thanh toán COD**.
- Thanh toán qua **PayPal Sandbox**.
- Xem **Đơn hàng**.
- **Theo dõi trạng thái đơn hàng**.
- Sử dụng **Đặt hoa theo yêu cầu**.
- Xem **Yêu cầu của tôi**.

### Admin

Admin là người quản trị hệ thống.

Admin có thể:

- Sử dụng **Admin Dashboard**.
- **Quản lý sản phẩm**.
- **Quản lý đơn hàng**.
- **Xem danh sách đơn hàng**.
- **Xem chi tiết đơn hàng**.
- **Cập nhật trạng thái đơn hàng**.
- Nhận **Thông báo yêu cầu đặt hoa**.
- **Nhận yêu cầu**.
- **Từ chối**.
- **Xác nhận & tạo đơn**.

### PayPal Sandbox

**PayPal Sandbox** là hệ thống bên ngoài được sử dụng để mô phỏng giao dịch thanh toán PayPal trong môi trường phát triển.

---

## ✨ Chức năng hệ thống

### 👤 Customer

| Chức năng | Mô tả |
|---|---|
| Đăng ký | Tạo tài khoản Customer |
| Đăng nhập | Xác thực tài khoản |
| Đăng xuất | Kết thúc phiên đăng nhập |
| Hồ sơ | Xem và cập nhật thông tin tài khoản |
| Trang chủ | Hiển thị nội dung chính của cửa hàng |
| Danh mục | Xem sản phẩm theo danh mục |
| Sản phẩm | Xem danh sách sản phẩm |
| Xem chi tiết | Xem thông tin chi tiết sản phẩm |
| Tìm kiếm | Tìm sản phẩm theo từ khóa |
| Yêu thích | Lưu và quản lý sản phẩm yêu thích |
| Thêm vào giỏ | Thêm sản phẩm vào giỏ hàng |
| Đặt hàng | Thực hiện quy trình đặt hàng |
| Giỏ hàng | Xem, cập nhật số lượng và xóa sản phẩm |
| Checkout | Nhập thông tin giao hàng và xác nhận đơn |
| Chọn ngày giao hàng | Chọn ngày giao phù hợp |
| Chọn khung giờ giao hàng | Chọn khung giờ giao |
| Thiệp/lời chúc | Thêm nội dung thiệp hoặc lời chúc |
| Gói quà | Chọn tùy chọn gói quà |
| Thanh toán COD | Thanh toán khi nhận hàng |
| PayPal Sandbox | Thanh toán thử nghiệm qua PayPal |
| Đơn hàng | Xem các đơn hàng đã tạo |
| Theo dõi trạng thái đơn hàng | Theo dõi tiến trình xử lý đơn |
| Đặt hoa theo yêu cầu | Gửi yêu cầu đặt hoa riêng |
| Yêu cầu của tôi | Xem các yêu cầu đã gửi |

---

### 👨‍💼 Admin

| Chức năng | Mô tả |
|---|---|
| Admin Dashboard | Trang tổng quan quản trị |
| Quản lý sản phẩm | Quản lý dữ liệu sản phẩm |
| Quản lý đơn hàng | Quản lý toàn bộ đơn hàng |
| Xem danh sách đơn hàng | Theo dõi danh sách đơn |
| Xem chi tiết đơn hàng | Xem đầy đủ thông tin từng đơn |
| Cập nhật trạng thái đơn hàng | Thay đổi tiến trình xử lý đơn |
| Thông báo yêu cầu đặt hoa | Nhận thông báo khi có yêu cầu mới |
| Nhận yêu cầu | Tiếp nhận yêu cầu đặt hoa |
| Từ chối | Từ chối yêu cầu khi cần |
| Xác nhận & tạo đơn | Chuyển yêu cầu đặt hoa thành đơn hàng |

---

## 🛍️ Quy trình đặt hàng

Quy trình đặt hàng chính của hệ thống:

```text
Customer
   ↓
Sản phẩm
   ↓
Xem chi tiết
   ↓
Thêm vào giỏ
   ↓
Giỏ hàng
   ↓
Checkout
   ↓
Nhập thông tin người nhận
   ↓
Chọn ngày giao hàng
   ↓
Chọn khung giờ giao hàng
   ↓
Thiệp/lời chúc
   ↓
Gói quà
   ↓
Chọn phương thức thanh toán
   ├── Thanh toán COD
   └── PayPal Sandbox
   ↓
Đặt hàng
   ↓
Tạo Order
   ↓
Tạo OrderItem
   ↓
Tạo Payment
   ↓
Đơn hàng
   ↓
Theo dõi trạng thái đơn hàng
```

### Thanh toán COD

```text
Checkout
   ↓
Thanh toán COD
   ↓
Tạo Order
   ↓
Payment ở trạng thái chờ thanh toán
   ↓
Admin xử lý đơn hàng
   ↓
Cập nhật trạng thái đơn hàng
```

### PayPal Sandbox

```text
Checkout
   ↓
PayPal Sandbox
   ↓
PayPal tạo giao dịch
   ↓
Customer xác nhận giao dịch
   ↓
Hệ thống nhận kết quả
   ↓
Cập nhật Payment
   ↓
Cập nhật Order
```

---

## 💐 Đặt hoa theo yêu cầu

BloomGift hỗ trợ chức năng **Đặt hoa theo yêu cầu** dành cho cả Guest và Customer.

Luồng xử lý:

```text
Guest / Customer
       ↓
Đặt hoa theo yêu cầu
       ↓
Nhập thông tin yêu cầu
       ↓
Gửi yêu cầu
       ↓
Hệ thống tạo yêu cầu
       ↓
Thông báo yêu cầu đặt hoa
       ↓
Admin xem chi tiết
       ↓
 ┌───────────────┬───────────────┐
 ↓               ↓               ↓
Nhận yêu cầu   Từ chối    Xác nhận & tạo đơn
                               ↓
                             Order
                               ↓
                         Đơn hàng
```

Customer đã đăng nhập có thể theo dõi các yêu cầu đã gửi tại:

```text
Yêu cầu của tôi
```

---

## 📦 Trạng thái đơn hàng

BloomGift sử dụng các trạng thái đơn hàng:

```text
pending
   ↓
confirmed
   ↓
processing
   ↓
shipping
   ↓
completed
```

Trường hợp đơn bị hủy:

```text
pending / confirmed / processing
              ↓
           cancelled
```

| Trạng thái | Ý nghĩa |
|---|---|
| `pending` | Chờ xử lý |
| `confirmed` | Đã xác nhận |
| `processing` | Đang chuẩn bị/xử lý |
| `shipping` | Đang giao |
| `completed` | Hoàn thành |
| `cancelled` | Đã hủy |

Trạng thái thanh toán được quản lý riêng bằng:

```text
payment_status
```

và dữ liệu trong bảng:

```text
payments
```

---

## 🛠️ Công nghệ sử dụng

### Backend

- PHP 8.2
- Laravel 12
- Laravel MVC

### Database

- MySQL

### Frontend

- Blade Template
- HTML5
- CSS3
- JavaScript

### Payment

- Thanh toán COD
- PayPal Sandbox

### Development Tools

- Visual Studio Code
- Composer
- Git
- GitHub
- MySQL

---

## 🏗️ Kiến trúc hệ thống

BloomGift được xây dựng theo kiến trúc **MVC của Laravel**.

```text
┌──────────────────────────────┐
│     Guest / Customer         │
│          Admin               │
└──────────────┬───────────────┘
               │
               ▼
┌──────────────────────────────┐
│          Blade View          │
│      HTML / CSS / JS         │
└──────────────┬───────────────┘
               │
               ▼
┌──────────────────────────────┐
│          Laravel 12          │
│                              │
│           Route              │
│             ↓                │
│         Controller           │
│             ↓                │
│      Model / Service         │
└──────────────┬───────────────┘
               │
               ▼
┌──────────────────────────────┐
│            MySQL             │
└──────────────────────────────┘
```

Đối với PayPal:

```text
Laravel
   ↓
PayPal Sandbox
   ↓
Laravel
   ↓
Payment / Order
```

Một số thành phần chính của hệ thống:

```text
CheckoutController
OrderController
Admin\OrderController
PayPalController
PayPalService
```

---

## 🗄️ Cơ sở dữ liệu

Các bảng/thực thể cốt lõi:

```text
users
products
cart_items
delivery_slots
orders
order_items
payments
custom_order_requests
```

Quan hệ nghiệp vụ chính:

```text
User
 ├── Cart Items
 ├── Orders
 └── Custom Order Requests
```

```text
Order
 ├── belongsTo DeliverySlot
 ├── hasMany OrderItem
 └── hasOne Payment
```

Một số trường dữ liệu chính của `orders`:

```text
id
order_code
recipient_name
recipient_phone
recipient_address
delivery_date
delivery_slot_id
subtotal
discount
shipping_fee
total
payment_method
payment_status
order_status
note
created_at
updated_at
```

Bảng `order_items` lưu thông tin sản phẩm thuộc đơn hàng.

Bảng `payments` lưu thông tin thanh toán.

Bảng `delivery_slots` lưu các khung giờ giao hàng.

Bảng `custom_order_requests` lưu thông tin **Đặt hoa theo yêu cầu**.

---

## 🚀 Cài đặt

### 1. Clone repository

```bash
git clone https://github.com/caohienITT05/TMDT_webbanhoa.git
```

Di chuyển vào thư mục project:

```bash
cd TMDT_webbanhoa
```

---

### 2. Cài đặt dependencies

```bash
composer install
```

---

### 3. Tạo file `.env`

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Hoặc tạo bản sao:

```text
.env.example
```

và đổi tên thành:

```text
.env
```

---

### 4. Tạo Application Key

```bash
php artisan key:generate
```

---

### 5. Cấu hình MySQL

Mở file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bloomgift_db
DB_USERNAME=root
DB_PASSWORD=
```

> Mỗi thành viên cấu hình `DB_USERNAME` và `DB_PASSWORD` theo MySQL trên máy của mình.

Không commit `.env` lên GitHub.

---

### 6. Chạy Migration

```bash
php artisan migrate
```

Nếu project có Seeder phù hợp:

```bash
php artisan db:seed
```

> Không sử dụng `php artisan migrate:fresh` trên database đang chứa dữ liệu cần giữ.

---

### 7. Khởi động Laravel

```bash
php artisan serve
```

Truy cập:

```text
http://127.0.0.1:8000
```

---

## 💳 Cấu hình PayPal Sandbox

BloomGift sử dụng **PayPal Sandbox** để mô phỏng giao dịch PayPal trong môi trường phát triển.

Các thông tin PayPal phải được đặt trong `.env`.

Ví dụ:

```env
PAYPAL_CLIENT_ID=your_sandbox_client_id
PAYPAL_CLIENT_SECRET=your_sandbox_client_secret
PAYPAL_MODE=sandbox
```

> Không commit `PAYPAL_CLIENT_SECRET`, API Key hoặc thông tin bảo mật lên GitHub.

---

## 🔒 Bảo mật và phân quyền

Hệ thống áp dụng các yêu cầu bảo mật cơ bản:

- Mật khẩu được Laravel băm trước khi lưu.
- Phân biệt quyền **Customer** và **Admin**.
- Customer không được truy cập khu vực Admin.
- Route quản trị được bảo vệ bằng middleware.
- Kiểm tra quyền truy cập đối với các chức năng Admin.
- Không lưu Client Secret hoặc mật khẩu trực tiếp trong source.
- Không commit `.env`.
- Dữ liệu `Order`, `OrderItem` và `Payment` phải được xử lý nhất quán.

---

## 👥 Phân công thành viên

Dự án được thực hiện bởi **03 thành viên** trong thời gian **10 tuần**.

| STT | Thành viên | Phần phụ trách |
|---:|---|---|
| 1 | **Tạ Công Chiến** | Checkout – Order – Payment – Đặt hoa theo yêu cầu |
| 2 | **Nguyễn Văn Tú** | Product – Catalog – Customer |
| 3 | **Nguyễn Lê Đức Anh** | Authentication – Profile – Admin/Core |

---

### 👨‍💻 Tạ Công Chiến

Phụ trách:

- Checkout
- Chọn ngày giao hàng
- Chọn khung giờ giao hàng
- Thiệp/lời chúc
- Gói quà
- Thanh toán COD
- PayPal Sandbox
- Đơn hàng
- Theo dõi trạng thái đơn hàng
- Quản lý đơn hàng
- Xem danh sách đơn hàng
- Xem chi tiết đơn hàng
- Cập nhật trạng thái đơn hàng
- Đặt hoa theo yêu cầu
- Yêu cầu của tôi
- Xác nhận & tạo đơn

---

### 👨‍💻 Nguyễn Văn Tú

Phụ trách:

- Trang chủ
- Danh mục
- Sản phẩm
- Xem chi tiết
- Tìm kiếm
- Yêu thích
- Quản lý sản phẩm
- Giao diện Customer
- Phối hợp dữ liệu sản phẩm trong Giỏ hàng
- Phối hợp dữ liệu sản phẩm trong Checkout

---

### 👨‍💻 Nguyễn Lê Đức Anh

Phụ trách:

- Đăng ký
- Đăng nhập
- Đăng xuất
- Hồ sơ
- Phân quyền Customer/Admin
- Admin Dashboard
- Tích hợp khu vực Admin
- Phối hợp Quản lý sản phẩm
- Phối hợp Quản lý đơn hàng
- Phối hợp Thông báo yêu cầu đặt hoa

---

## 📅 Kế hoạch thực hiện 10 tuần

Kế hoạch được tổ chức theo đúng trình tự của một dự án phần mềm:

```text
Khảo sát
   ↓
Phân tích BA
   ↓
Thiết kế hệ thống
   ↓
Lập trình
   ↓
Tích hợp
   ↓
Kiểm thử
   ↓
Hoàn thiện
```

| Tuần | Thời gian | Nội dung chính |
|---:|---|---|
| 1 | 26/08 – 30/08 | Khởi động dự án, khảo sát bài toán, xác định mục tiêu, phạm vi và tác nhân |
| 2 | 31/08 – 06/09 | Phân tích BA, yêu cầu chức năng, yêu cầu phi chức năng, Use Case tổng quát và Use Case chi tiết |
| 3 | 07/09 – 13/09 | Thiết kế ERD, database, kiến trúc Laravel MVC, Sitemap và Wireframe |
| 4 | 14/09 – 20/09 | Thiết kế Activity Diagram, Sequence Diagram, State Diagram và chốt cấu trúc kỹ thuật |
| 5 | 21/09 – 27/09 | Khởi tạo và triển khai các module nền tảng |
| 6 | 28/09 – 04/10 | Triển khai Giỏ hàng, Checkout, thông tin giao hàng, Thiệp/lời chúc và Gói quà |
| 7 | 05/10 – 11/10 | Triển khai Đơn hàng, Thanh toán COD và Quản lý đơn hàng |
| 8 | 12/10 – 18/10 | Tích hợp PayPal Sandbox và Đặt hoa theo yêu cầu |
| 9 | 19/10 – 25/10 | Tích hợp toàn hệ thống, kiểm thử chức năng và sửa lỗi |
| 10 | 26/10 – 30/10 | Hoàn thiện báo cáo, regression, đóng gói source và chuẩn bị bảo vệ |

---

## 🌿 Nguyên tắc làm việc với Git

Repository:

```text
https://github.com/caohienITT05/TMDT_webbanhoa.git
```

Nhánh tích hợp chính:

```text
develop
```

Mỗi thành viên làm việc trên branch riêng.

Ví dụ:

```text
feature/chien-order-payment
feature/tu-product
feature/ducanh-auth-admin
```

### Quy trình làm việc

Trước khi code:

```bash
git checkout develop
git pull origin develop
```

Tạo branch cá nhân:

```bash
git checkout -b feature/ten-branch
```

Sau khi hoàn thành một phần công việc:

```bash
git status
git add .
git commit -m "Mo ta noi dung da lam"
git push origin feature/ten-branch
```

Sau đó:

```text
Feature Branch
      ↓
Push lên GitHub
      ↓
Tạo Pull Request
      ↓
Review
      ↓
Merge vào develop
```

### Quy tắc chung

- Không commit `.env`.
- Không commit PayPal Client Secret.
- Không commit password hoặc API Key.
- Không `force push` lên `develop`.
- Không tự ý xóa database chung.
- Không sử dụng `migrate:fresh` khi database đang có dữ liệu cần giữ.
- Trước khi merge phải `pull` phiên bản mới nhất.
- Kiểm tra conflict trước khi merge.
- Mỗi commit cần ghi rõ nội dung đã thay đổi.
- Không sửa module của thành viên khác nếu chưa thống nhất.
- Sau khi merge phải kiểm tra lại các chức năng liên quan.

---

## 📄 Mục đích sử dụng

Dự án BloomGift được xây dựng phục vụ:

**Đồ án cơ sở Công nghệ thông tin**

và các mục đích:

- Học tập.
- Nghiên cứu.
- Thực hành phát triển phần mềm.
- Phân tích và thiết kế hệ thống.
- Thực hành Laravel.
- Thực hành MySQL.
- Thực hành Git và GitHub.
- Thực hành tích hợp hệ thống.

---

## 🌸 BloomGift

**BloomGift – Gửi yêu thương qua từng đóa hoa và món quà.**
