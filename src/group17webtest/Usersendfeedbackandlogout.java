package group17webtest;

import java.util.concurrent.TimeUnit;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

public class Usersendfeedbackandlogout {
public static void main(String[] args) {
		
		System.setProperty("webdriver.chrome.driver", "chromedriver");
	
		WebDriver driver = new ChromeDriver();

		driver.get("https://salty-scrubland-05316.herokuapp.com/");
		driver.manage().timeouts().implicitlyWait(200, TimeUnit.SECONDS);	
		WebDriverWait wait = new WebDriverWait(driver,50);
		
		driver.findElement(By.linkText("Login")).click();
		
		
		driver.findElement(By.name("email")).sendKeys("zhou@gmail");
		driver.findElement(By.name("password")).sendKeys("Conan19910101");
		driver.findElement(By.xpath("//*[@id=\'app\']/main/div/div/div/div/div[2]/form/div[4]/div/button")).click();
		
		driver.findElement(By.name("name")).sendKeys("zhousama");
		driver.findElement(By.name("email")).sendKeys("zhou@gmail");
		driver.findElement(By.name("subject")).sendKeys("test");
		driver.findElement(By.name("message")).sendKeys("thisisatest");
		try {
			Thread.sleep(5000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		driver.findElement(By.xpath("//*[@id=\'contact-form\']/div[4]/button")).click();
		try {
			Thread.sleep(5000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		driver.findElement(By.xpath("//*[@id=\'navbarDropdown\']")).click();
		driver.findElement(By.xpath("//*[@id=\'navbarSupportedContent\']/ul/li[2]/div/a[2]")).click();
	
		
}
}
