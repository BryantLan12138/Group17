package group17webtest;

import java.util.concurrent.TimeUnit;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;


public class Userchooseandbookingcar {
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
		

		try {
			Thread.sleep(3000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		driver.findElement(By.xpath("//*[@id=\'main\']/button[1]")).click();
		try {
			Thread.sleep(3000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		driver.findElement(By.xpath("//*[@id=\'mySidebar\']/div/div/ul/li[1]/a")).click();
		try {
			Thread.sleep(3000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		driver.findElement(By.xpath("//*[@id=\'app\']/main/div/div/div[1]/form[2]/button")).click();
		try {
			Thread.sleep(3000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		
		
}

}
