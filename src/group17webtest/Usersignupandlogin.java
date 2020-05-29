package group17webtest;

import java.util.concurrent.TimeUnit;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;


public class Usersignupandlogin {
	
	public static void main(String[] args) {
		
		System.setProperty("webdriver.chrome.driver", "chromedriver");
	
		WebDriver driver = new ChromeDriver();

		driver.get("https://salty-scrubland-05316.herokuapp.com/");
		driver.manage().timeouts().implicitlyWait(200, TimeUnit.SECONDS);	
		WebDriverWait wait = new WebDriverWait(driver,50);
		
		driver.findElement(By.linkText("Register")).click();
		
		driver.findElement(By.name("name")).sendKeys("zhousama");
		driver.findElement(By.name("email")).sendKeys("zhou@gmail.com");
		driver.findElement(By.name("password")).sendKeys("Conan19910101");
		driver.findElement(By.name("password_confirmation")).sendKeys("Conan19910101");
		
		driver.findElement(By.xpath("//*[@id=\'app\']/main/div/div/div/div/div[2]/form/div[5]/div/button")).click();
		
}
}