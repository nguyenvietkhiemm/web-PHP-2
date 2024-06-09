<?php
class HomeController
{
    public $conn;

    public function __construct()
    {
        try {
            global $conn;
            $this->conn = $conn;
        } catch (mysqli_sql_exception) {
            echo "Could not show data";
        }
    }
    public function index()
    {
        $total_earning_today_sql = "SELECT SUM(od.total_money) AS total_earning_today
        FROM order_details od
        JOIN orders o ON od.order_id = o.id
        WHERE od.order_type = 'order' AND DATE(o.order_date) = CURDATE();";
        $total_earning_today = mysqli_fetch_assoc(mysqli_query($this->conn, $total_earning_today_sql))['total_earning_today'];
        $total_earning_today = $total_earning_today != null ? $total_earning_today : 0;
        ////////////////////////////////////////////////////////////////////////
        $total_expense_today_sql = "SELECT SUM(od.total_money) AS total_expense_today
        FROM order_details od
        JOIN orders o ON od.order_id = o.id
        WHERE od.order_type = 'imported_order' AND DATE(o.order_date) = CURDATE();";
        $total_expense_today = mysqli_fetch_assoc(mysqli_query($this->conn, $total_expense_today_sql))['total_expense_today'];
        $total_expense_today = $total_expense_today != null ? $total_expense_today : 0;
        ////////////////////////////////////////////////////////////////////////
        $total_earning_month_sql = "SELECT SUM(od.total_money) AS total_earning_month
        FROM order_details od
        JOIN orders o ON od.order_id = o.id
        WHERE od.order_type = 'order'
          AND YEAR(o.order_date) = YEAR(CURDATE())
          AND MONTH(o.order_date) = MONTH(CURDATE());";
        $total_earning_month = mysqli_fetch_assoc(mysqli_query($this->conn, $total_earning_month_sql))['total_earning_month'];
        $total_earning_month = $total_earning_month != null ? $total_earning_month : 0;
        ////////////////////////////////////////////////////////////////
        $total_earning_week_sql = "WITH RECURSIVE DateRange AS (
            SELECT CURDATE() - INTERVAL 9 DAY AS order_day
            UNION ALL
            SELECT order_day + INTERVAL 1 DAY
            FROM DateRange
            WHERE order_day + INTERVAL 1 DAY <= CURDATE()
        )
        SELECT 
            dr.order_day,
            COALESCE(SUM(od.total_money), 0) AS total_earning_day
        FROM 
            DateRange dr
        LEFT JOIN 
            orders o ON DATE(o.order_date) = dr.order_day
        LEFT JOIN 
            order_details od ON od.order_id = o.id AND od.order_type = 'order'
        GROUP BY 
            dr.order_day
        ORDER BY 
            dr.order_day;";
        $total_earning_week = mysqli_query($this->conn, $total_earning_week_sql);
        ////////////////////////////////////////////////////////////////////////
        $category_id_count_sql = "SELECT c.name AS category_name, p.category_id, COUNT(p.id) AS product_count
        FROM products p INNER JOIN categories c ON p.category_id = c.id
        WHERE p.deleted = false
        GROUP BY p.category_id;";
        $category_id_count = mysqli_query($this->conn, $category_id_count_sql);
        ////////////////////////////////////////////////////////////////////////
        $five_min_sql = "SELECT id, name, count
        FROM products
        ORDER BY count ASC
        LIMIT 5;";
        $five_min = mysqli_query($this->conn, $five_min_sql);
        ////////////////////////////////////////////////////////////////////////
        $five_max_sql = "SELECT p.id, p.name, SUM(od.number_of_products) AS count
        FROM products p
        JOIN order_details od ON p.id = od.product_id
        JOIN orders o ON od.order_id = o.id
        WHERE od.order_type = 'order' -- Chỉ tính số lượng từ các đơn hàng thường (order)
        GROUP BY p.id, p.name
        ORDER BY count DESC
        LIMIT 5;";
        $five_max = mysqli_query($this->conn, $five_max_sql);
        ////////////////////////////////////////////////////////////////////////

        include __DIR__ . ('\..\..\resources\views\home.php');
    }
}

return new HomeController;
